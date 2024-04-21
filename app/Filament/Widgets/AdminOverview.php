<?php

namespace App\Filament\Widgets;

use App\Models\Clinic;
use App\Models\Assessor;
use App\Models\Assessment;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class AdminOverview extends BaseWidget
{
    protected function getStats(): array
    {

        $clinicCount = Clinic::all()->count();
        $assessorCount = Assessor::all()->count();
        $assessmentCount = Assessment::all()->count();

        return [
            Stat::make('Clinics', $clinicCount)
                ->description('Total Number of Clinics')
                ->descriptionIcon('heroicon-o-building-office')
                ->color('primary'),
            Stat::make('Assessors', $assessorCount)
                ->description('Total Number of Assessors')
                ->descriptionIcon('heroicon-o-user')
                ->color('primary'),
            Stat::make('Assessments', $assessmentCount)
                ->description('Total Number of Assessments')
                ->descriptionIcon('heroicon-o-document-check')
                ->color('primary'),
        ];
    }
    protected static ?int $sort = 1;
}
