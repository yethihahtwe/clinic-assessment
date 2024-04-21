<?php

namespace App\Filament\User\Widgets;

use App\Models\Clinic;
use App\Models\Assessor;
use App\Models\Assessment;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ClinicsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {

        $abbr = auth()->user()->organization->abbr;
        $clinicCount = Clinic::where('organization_id', auth()->user()->organization_id)->count();
        $assessorCount = Assessor::where('organization_id', auth()->user()->organization_id)->count();
        $assessmentCount = Assessment::where('organization_id', auth()->user()->organization_id)->count();

        return [
            Stat::make('Clinics', $clinicCount)
                ->description('Number of Clinics registered by the ' . $abbr)
                ->descriptionIcon('heroicon-o-building-office')
                ->color('primary'),
            Stat::make('Assessors', $assessorCount)
                ->description('Number of ' . $abbr . ' Assessors')
                ->descriptionIcon('heroicon-o-user')
                ->color('primary'),
            Stat::make('Assessments', $assessmentCount)
                ->description('Number of Assessments made by the ' . $abbr)
                ->descriptionIcon('heroicon-o-document-check')
                ->color('primary'),
        ];
    }
}
