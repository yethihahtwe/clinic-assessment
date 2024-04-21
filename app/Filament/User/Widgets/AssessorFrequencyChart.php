<?php

namespace App\Filament\User\Widgets;

use App\Models\Assessor;
use App\Models\Assessment;
use Filament\Widgets\ChartWidget;

class AssessorFrequencyChart extends ChartWidget
{
    protected static ?string $heading = 'Assessments made by each person';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $assessors = Assessor::where('organization_id', auth()->user()->organization_id)->get();
        $label = [];
        $data = [];
        foreach ($assessors as $assessor)
        {
            $assessments = Assessment::where('assessor_id', $assessor->id)->count();
            $label[] = $assessor->name;
            $data[] = $assessments;
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

    protected static string $color = 'info';
}
