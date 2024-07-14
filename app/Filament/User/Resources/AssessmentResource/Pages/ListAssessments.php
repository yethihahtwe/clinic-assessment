<?php

namespace App\Filament\User\Resources\AssessmentResource\Pages;

use App\Filament\User\Resources\AssessmentResource;
use App\Services\AppIcons;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssessments extends ListRecords
{
    protected static string $resource = AssessmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->icon(AppIcons::ADD_ICON),
        ];
    }
}
