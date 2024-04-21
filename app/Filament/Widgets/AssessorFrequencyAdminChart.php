<?php

namespace App\Filament\Widgets;

use App\Models\Assessor;
use App\Models\Assessment;
use App\Models\Organization;
use Filament\Widgets\ChartWidget;

class AssessorFrequencyAdminChart extends ChartWidget
{
    protected static ?string $heading = 'Number of assessors per organization';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $organizations = Organization::withCount('assessors')->get()->sortByDesc('assessors_count');

        $label = [];
        $data = [];
        foreach ($organizations as $organization)
        {
            $label[] = $organization->abbr;
            $data[] = $organization->assessors_count;
        }
        return [
            'datasets' => [
                [
                    'label' => 'Number of Assessors',
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

    protected static string $color = 'success';
}
