<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class UserPercentage extends ChartWidget
{
    protected static ?string $heading = 'Percentage of users per organization';

    protected static ?int $sort = 5;

    protected function getData(): array
    {
        $organizations = \App\Models\Organization::withCount('users')->get()->sortByDesc('users_count');
        $labels = [];
        $data = [];

        foreach ($organizations as $organization) {
            $labels[] = $organization->abbr;
            $data[] = $organization->users_count;
        }
        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Percentage of users',
                    'data' => $data,
                ]
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    protected static string $color = 'info';

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
        ];
    }
    protected static ?string $maxHeight = '300px';
}
