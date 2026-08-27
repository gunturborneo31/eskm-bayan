<?php

namespace App\Http\Controllers;

use App\Exports\TenantRevenueExport;
use App\Models\TenantRevenue;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TenantRevenueController extends Controller
{
    public function create()
    {
        return view('tenant-revenue.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'revenue_date' => ['required', 'date'],
            'merchant_name' => ['required', 'string', 'max:150'],
            'amount' => ['required', 'numeric', 'min:0'],
        ], [
            'revenue_date.required' => 'Tanggal wajib diisi.',
            'merchant_name.required' => 'Nama merchant wajib diisi.',
            'amount.required' => 'Nominal pendapatan wajib diisi.',
            'amount.numeric' => 'Nominal pendapatan harus berupa angka.',
            'amount.min' => 'Nominal pendapatan tidak boleh kurang dari nol.',
        ]);

        $validated['merchant_name'] = trim($validated['merchant_name']);
        TenantRevenue::create($validated);

        return back()->with('success', 'Rekapan pendapatan berhasil disimpan.');
    }

    public function publicDashboard(Request $request)
    {
        return view('tenant-revenue.dashboard', $this->dashboardData($request));
    }

    public function adminDashboard(Request $request)
    {
        return view('tenant-revenue.admin-dashboard', $this->dashboardData($request));
    }

    public function export(Request $request, string $format)
    {
        abort_unless(in_array($format, ['excel', 'pdf'], true), 404);

        $data = $this->dashboardData($request);
        $filename = 'akumulasi-pendapatan-tenant-' . $data['from'] . '-' . $data['to'];

        if ($format === 'excel') {
            return Excel::download(
                new TenantRevenueExport($data['summary'], $data['dateColumns']),
                $filename . '.xlsx'
            );
        }

        return Pdf::loadView('tenant-revenue.export-pdf', $data)
            ->setPaper('a4', 'landscape')
            ->download($filename . '.pdf');
    }

    public function destroy(Request $request, TenantRevenue $tenantRevenue)
    {
        $sameTenantEntries = TenantRevenue::query()
            ->whereDate('revenue_date', $tenantRevenue->revenue_date)
            ->get()
            ->filter(fn (TenantRevenue $entry) => mb_strtolower(trim($entry->merchant_name)) === mb_strtolower(trim($tenantRevenue->merchant_name)));

        if ($sameTenantEntries->count() <= 1) {
            return response()->json(['message' => 'Entri terakhir tidak boleh dihapus. Sisakan minimal satu entri.'], 422);
        }

        $tenantRevenue->delete();

        return response()->json(['message' => 'Entri duplikat berhasil dihapus.']);
    }

    private function dashboardData(Request $request): array
    {
        $from = $request->input('from', now()->toDateString());
        $to = $request->input('to', now()->toDateString());
        $rangeDays = Carbon::parse($from)->diffInDays(Carbon::parse($to)) + 1;
        $dateColumns = CarbonPeriod::create($from, $to);
        $sort = in_array($request->input('sort'), ['name', 'date', 'total'], true)
            ? $request->input('sort')
            : 'total';
        $direction = $request->input('direction') === 'asc' ? 'asc' : 'desc';

        $entries = TenantRevenue::query()
            ->whereBetween('revenue_date', [$from, $to]);

        if ($sort === 'name') {
            $entries->orderBy('merchant_name', $direction);
        } elseif ($sort === 'date') {
            $entries->orderBy('revenue_date', $direction);
        } else {
            $entries->orderByDesc('revenue_date')->orderBy('merchant_name');
        }

        $entries = $entries->get();

        $summary = $entries->groupBy(function (TenantRevenue $entry) {
            return mb_strtolower(trim($entry->merchant_name));
        })->map(function ($merchantEntries) {
            return [
                'key' => mb_strtolower(trim($merchantEntries->first()->merchant_name)),
                'name' => $merchantEntries->first()->merchant_name,
                'total' => $merchantEntries->sum('amount'),
                'days' => $merchantEntries->pluck('revenue_date')->unique()->count(),
                'input_dates' => $merchantEntries->pluck('revenue_date')
                    ->map(fn ($date) => $date->format('d/m/Y'))
                    ->unique()
                    ->values()
                    ->implode(', '),
                'latest_date' => $merchantEntries->max('revenue_date'),
                'amount_by_date' => $merchantEntries->groupBy(fn ($entry) => substr((string) $entry->revenue_date, 0, 10))
                    ->map(fn ($dateEntries) => $dateEntries->sum('amount')),
                'entries_by_date' => $merchantEntries->groupBy(fn ($entry) => substr((string) $entry->revenue_date, 0, 10))
                    ->map(fn ($dateEntries) => $dateEntries->map(fn ($entry) => [
                        'id' => $entry->id,
                        'amount' => (float) $entry->amount,
                        'created_at' => $entry->created_at?->format('d/m/Y H:i'),
                    ])->values()->all())
                    ->all(),
            ];
        });

        $summary = match ($sort) {
            'name' => $summary->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE, $direction === 'desc'),
            'date' => $summary->sortBy('latest_date', SORT_REGULAR, $direction === 'desc'),
            default => $summary->sortBy('total', SORT_NUMERIC, $direction === 'desc'),
        };
        $summary = $summary->values();

        return [
            'from' => $from,
            'to' => $to,
            'dateColumns' => collect($dateColumns)->map(fn ($date) => $date->format('Y-m-d')),
            'sort' => $sort,
            'direction' => $direction,
            'summary' => $summary,
            'entries' => $entries,
            'grandTotal' => $entries->sum('amount'),
            'previousUrl' => $request->fullUrlWithQuery([
                'from' => Carbon::parse($from)->subDays($rangeDays)->toDateString(),
                'to' => Carbon::parse($to)->subDays($rangeDays)->toDateString(),
            ]),
            'nextUrl' => $request->fullUrlWithQuery([
                'from' => Carbon::parse($from)->addDays($rangeDays)->toDateString(),
                'to' => Carbon::parse($to)->addDays($rangeDays)->toDateString(),
            ]),
            'sortUrl' => static function (string $column) use ($request, $sort, $direction): string {
                $nextDirection = $sort === $column && $direction === 'asc' ? 'desc' : 'asc';

                return $request->fullUrlWithQuery([
                    'sort' => $column,
                    'direction' => $nextDirection,
                ]);
            },
        ];
    }
}
