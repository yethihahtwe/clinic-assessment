<?php

namespace App\Filament\User\Widgets;

use App\Models\Clinic;
use App\Models\Assessment;
use Filament\Widgets\ChartWidget;

class AssessmentFrequencyChart extends ChartWidget
{
    protected static ?string $heading = 'Assessments received by each clinic';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $clinics = Clinic::where('organization_id', auth()->user()->organization_id)->get();
        $label = [];
        $data = [];
        foreach ($clinics as $clinic)
        {
            $assessments = Assessment::where('clinic_id', $clinic->id)->count();
            $label[] = $clinic->name;
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

    protected static string $color = 'warning';
}
