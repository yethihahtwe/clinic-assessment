<?php

namespace App\Filament\Widgets;

use App\Models\Assessment;
use App\Models\Organization;
use Filament\Widgets\ChartWidget;

class AssessmentFrequencyAdminChart extends ChartWidget
{
    protected static ?string $heading = 'Assessments made by each organization';
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $organizations = Organization::withCount('assessments')->get()->sortByDesc('assessments_count');
        $label = [];
        $data = [];
        foreach ($organizations as $organization)
        {
            $label[] = $organization->abbr;
            $data[] = $organization->assessments_count;
        }
        return [
            'datasets' => [
                [
                    'label' => 'Number of Assessments',
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
    ];

    protected static string $color = 'warning';
}
