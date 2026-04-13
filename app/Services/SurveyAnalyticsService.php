<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SurveyAnalyticsService
{
    public function availableYears(): array
    {
        $years = [];

        foreach (range(2023, (int) date('Y') + 1) as $year) {
            if (Schema::hasTable((string) $year)) {
                $years[] = $year;
            }
        }

        if (Schema::hasTable('survey_responses')) {
            $yearsFromUnified = DB::table('survey_responses')
                ->select('tahun')
                ->distinct()
                ->orderBy('tahun')
                ->pluck('tahun')
                ->map(fn ($y) => (int) $y)
                ->all();

            $years = array_values(array_unique(array_merge($years, $yearsFromUnified)));
            sort($years);
        }

        return $years;
    }

    public function departmentOptions(): array
    {
        return config('skm.departments', []);
    }

    public function defaultDepartments(): array
    {
        return array_keys($this->departmentOptions());
    }

    public function summarize(int $year, int $period, array $departments): array
    {
        $table = $this->resolveTable($year);
        $resolvedDepartments = $this->normalizeDepartments($departments);

        if ($table === null) {
            return $this->emptySummary($year, $period, $resolvedDepartments);
        }

        [$startDate, $endDate] = $this->resolvePeriodRange($year, $period);

        $baseQuery = DB::table($table)
            ->whereBetween('created_at', [$startDate->toDateString(), $endDate->toDateString()]);

        if ($table === 'survey_responses') {
            $baseQuery->where('tahun', $year);
        }

        if ($resolvedDepartments !== []) {
            $baseQuery->whereIn('jenisPelayanan', $resolvedDepartments);
        }

        // ── Query 1: aggregate totals (count + score sum + suggestions) in one trip ──
        $aggregate = (clone $baseQuery)
            ->selectRaw(
                'COUNT(*) as total_responses,'
                . ' COALESCE(SUM(u1 + u2 + u3 + u4 + u5 + u6 + u7 + u8 + u9), 0) as score_sum,'
                . ' SUM(CASE WHEN saran IS NOT NULL AND saran != \'\' THEN 1 ELSE 0 END) as suggestions_count'
            )
            ->first();

        $responses   = (int)   ($aggregate->total_responses ?? 0);
        $scoreSum    = (float) ($aggregate->score_sum        ?? 0);
        $suggestionsCount = (int) ($aggregate->suggestions_count ?? 0);

        $averageSkm = $responses > 0
            ? round(($scoreSum / ($responses * 9)) * 25, 2)
            : 0.0;

        // ── Query 2: monthly counts + department breakdown via a single grouped query ──
        $grouped = (clone $baseQuery)
            ->selectRaw('MONTH(created_at) as month_number, jenisPelayanan, COUNT(*) as total')
            ->groupByRaw('MONTH(created_at), jenisPelayanan')
            ->orderByRaw('MONTH(created_at)')
            ->get();

        $monthlyCounts = $grouped->groupBy('month_number')->map(fn ($rows) => $rows->sum('total'));

        $departmentCounts = $grouped
            ->groupBy('jenisPelayanan')
            ->map(fn ($rows, $dept) => [
                'code'  => $this->normalizeDepartment((string) $dept),
                'label' => $this->departmentLabel((string) $dept),
                'total' => (int) $rows->sum('total'),
            ])
            ->sortByDesc('total')
            ->values();

        // ── Query 3: recent submissions ──
        $recentResponses = (clone $baseQuery)
            ->select(['nama', 'jenisPelayanan', 'created_at'])
            ->orderByDesc('created_at')
            ->limit(6)
            ->get()
            ->map(fn ($row) => [
                'name'       => $row->nama ?: 'Anonim',
                'department' => $this->departmentLabel((string) $row->jenisPelayanan),
                'created_at' => Carbon::parse($row->created_at)->locale('id')->translatedFormat('d M Y H:i'),
            ]);

        return [
            'table' => $table,
            'year' => $year,
            'period' => $period,
            'period_label' => config('skm.periods.' . $period, 'Satu Tahun'),
            'date_range_label' => $startDate->locale('id')->translatedFormat('d M Y') . ' - ' . $endDate->locale('id')->translatedFormat('d M Y'),
            'departments' => $resolvedDepartments,
            'department_labels' => array_map(fn (string $department) => $this->departmentLabel($department), $resolvedDepartments),
            'responses' => $responses,
            'average_skm' => $averageSkm,
            'grade' => $this->grade($averageSkm),
            'active_departments' => $departmentCounts->count(),
            'suggestions_count' => $suggestionsCount,
            'latest_response' => $recentResponses->first()['created_at'] ?? '-',
            'monthly_chart' => $this->monthlySeries($monthlyCounts),
            'department_breakdown' => $departmentCounts->all(),
            'recent_responses' => $recentResponses->all(),
        ];
    }

    public function departmentLabel(string $department): string
    {
        $normalized = $this->normalizeDepartment($department);

        return Arr::get($this->departmentOptions(), $normalized, strtoupper($normalized));
    }

    public function normalizeDepartments(array $departments): array
    {
        return collect($departments)
            ->map(fn ($department) => $this->normalizeDepartment((string) $department))
            ->filter(fn ($department) => Arr::has($this->departmentOptions(), $department))
            ->unique()
            ->values()
            ->all();
    }

    private function normalizeDepartment(string $department): string
    {
        $key = strtolower(trim($department));

        return config('skm.aliases.' . $key, $key);
    }

    private function resolveTable(int $year): ?string
    {
        if (Schema::hasTable((string) $year)) {
            return (string) $year;
        }

        if (Schema::hasTable('survey_responses')) {
            return 'survey_responses';
        }

        $fallbackYear = collect($this->availableYears())
            ->map(fn ($y) => (string) $y)
            ->filter(fn ($y) => Schema::hasTable($y))
            ->sortDesc()
            ->first();

        return $fallbackYear ? (string) $fallbackYear : null;
    }

    private function resolvePeriodRange(int $year, int $period): array
    {
        $ranges = [
            1 => [Carbon::create($year, 1, 1)->startOfDay(), Carbon::create($year, 3, 31)->endOfDay()],
            2 => [Carbon::create($year, 4, 1)->startOfDay(), Carbon::create($year, 6, 30)->endOfDay()],
            3 => [Carbon::create($year, 1, 1)->startOfDay(), Carbon::create($year, 6, 30)->endOfDay()],
            4 => [Carbon::create($year, 7, 1)->startOfDay(), Carbon::create($year, 9, 30)->endOfDay()],
            5 => [Carbon::create($year, 1, 1)->startOfDay(), Carbon::create($year, 9, 30)->endOfDay()],
            6 => [Carbon::create($year, 10, 1)->startOfDay(), Carbon::create($year, 12, 31)->endOfDay()],
            7 => [Carbon::create($year, 1, 1)->startOfDay(), Carbon::create($year, 12, 31)->endOfDay()],
        ];

        return $ranges[$period] ?? $ranges[7];
    }

    private function monthlySeries(Collection $monthlyCounts): array
    {
        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $series = [];
        $max = max(1, (int) $monthlyCounts->max());

        foreach ($labels as $index => $label) {
            $monthNumber = $index + 1;
            $value = (int) ($monthlyCounts[$monthNumber] ?? 0);

            $series[] = [
                'label' => $label,
                'value' => $value,
                'height' => max(10, (int) round(($value / $max) * 100)),
            ];
        }

        return $series;
    }

    private function grade(float $averageSkm): string
    {
        return match (true) {
            $averageSkm >= 88.31 => 'A / Sangat Baik',
            $averageSkm >= 76.61 => 'B / Baik',
            $averageSkm >= 65 => 'C / Cukup',
            $averageSkm > 0 => 'D / Perlu Perbaikan',
            default => 'Belum Ada Data',
        };
    }

    private function emptySummary(int $year, int $period, array $departments): array
    {
        return [
            'table' => null,
            'year' => $year,
            'period' => $period,
            'period_label' => config('skm.periods.' . $period, 'Satu Tahun'),
            'date_range_label' => '-',
            'departments' => $departments,
            'department_labels' => [],
            'responses' => 0,
            'average_skm' => 0,
            'grade' => 'Belum Ada Data',
            'active_departments' => 0,
            'suggestions_count' => 0,
            'latest_response' => '-',
            'monthly_chart' => $this->monthlySeries(collect()),
            'department_breakdown' => [],
            'recent_responses' => [],
        ];
    }
}