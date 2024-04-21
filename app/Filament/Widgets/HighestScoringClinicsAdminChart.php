<?php

namespace App\Filament\Widgets;

use App\Models\Clinic;
use App\Models\Assessment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class HighestScoringClinicsAdminChart extends ChartWidget
{
    protected static ?string $heading = 'Top 10 Highest Scoring Assessments';
    protected static ?int $sort = 5;

    protected function getData(): array
    {
        $assessments = Assessment::all()->map(function ($assessment) {
            $clinic = $assessment->clinic->name;
            $date = $assessment->date;
            $choices = collect($assessment->choices);
            $sum = $choices->sum();
            return [
                'clinic' => $clinic,
                'date' => $date,
                'sum' => $sum,
            ];
        })->sortByDesc('sum')->take(10);
        $label = [];
        foreach ($assessments as $assessment) {
            $label[] = $assessment['clinic'] . ' (' . $assessment['date'] . ')';
        }
        $data = $assessments->pluck('sum');

        return [
            'datasets' => [
                [
                    'label' => 'Total Score',
                    'data' => $data,
                ],
            ],
            'labels' => $label,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected static ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => false,
            ],
        ],
        'scales' => [
            'y' => [
                'beginAtZero' => false,
            ],
        ],
    ];

    protected static string $color = 'info';
}
