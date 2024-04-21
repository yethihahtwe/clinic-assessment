<?php

namespace App\Filament\Widgets;

use App\Models\Organization;
use Filament\Widgets\ChartWidget;

class ClinicFrequencyAdminChart extends ChartWidget
{
    protected static ?string $heading = 'Number of clinics per organization';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $organizations = Organization::withCount('clinics')->get()->sortByDesc('clinics_count');
        $label = [];
        $data = [];

        foreach ($organizations as $organization)
        {
            $label[] = $organization->abbr;
            $data[] = $organization->clinics_count;
        }
        return [
            'datasets' => [
                [
                    'label' => 'Number of clinics',
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

    protected static string $color = 'danger';
}
