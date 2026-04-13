<?php

namespace App\Livewire;

use App\Services\SurveyAnalyticsService;
use Livewire\Attributes\Url;
use Livewire\Component;

class HomeDashboard extends Component
{
    #[Url(as: 'Tahun')]
    public ?int $year = null;

    #[Url(as: 'tw')]
    public int $period = 7;

    #[Url(as: 'bagian')]
    public array $departments = [];

    public function mount(SurveyAnalyticsService $analytics): void
    {
        $availableYears = $analytics->availableYears();
        $defaultYear = (int) (end($availableYears) ?: date('Y'));

        $this->year = $this->year ?: $defaultYear;
        $this->period = $this->period ?: 7;
        $this->departments = $this->departments ?: $analytics->defaultDepartments();
    }

    public function toggleDepartment(string $department): void
    {
        if (in_array($department, $this->departments, true)) {
            $this->departments = array_values(array_filter(
                $this->departments,
                fn (string $item) => $item !== $department,
            ));

            if ($this->departments === []) {
                $this->departments = app(SurveyAnalyticsService::class)->defaultDepartments();
            }

            return;
        }

        $this->departments[] = $department;
        $this->departments = array_values(array_unique($this->departments));
    }

    public function selectAllDepartments(): void
    {
        $this->departments = app(SurveyAnalyticsService::class)->defaultDepartments();
    }

    public function render(SurveyAnalyticsService $analytics)
    {
        $activeYear = (int) ($this->year ?: date('Y'));
        $departments = $analytics->normalizeDepartments($this->departments);

        return view('livewire.home-dashboard', [
            'availableYears' => $analytics->availableYears(),
            'periodOptions' => config('skm.periods', []),
            'departmentOptions' => $analytics->departmentOptions(),
            'summary' => $analytics->summarize($activeYear, $this->period, $departments),
        ]);
    }
}