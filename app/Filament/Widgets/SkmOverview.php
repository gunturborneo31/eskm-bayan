<?php

namespace App\Filament\Widgets;

use App\Services\SurveyAnalyticsService;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SkmOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $analytics = app(SurveyAnalyticsService::class);
        $year = collect($analytics->availableYears())->sortDesc()->first() ?? (int) date('Y');
        $summary = $analytics->summarize($year, 7, $analytics->defaultDepartments());

        return [
            Stat::make('Nilai SKM', number_format($summary['average_skm'], 2))
                ->description($summary['grade'])
                ->color('success'),
            Stat::make('Responden', number_format($summary['responses']))
                ->description('Data tahun ' . $year)
                ->color('primary'),
            Stat::make('Saran Masuk', number_format($summary['suggestions_count']))
                ->description('Masukan non-kosong')
                ->color('warning'),
            Stat::make('Update Terakhir', $summary['latest_response'])
                ->description('Snapshot lintas bagian')
                ->color('gray'),
        ];
    }
}