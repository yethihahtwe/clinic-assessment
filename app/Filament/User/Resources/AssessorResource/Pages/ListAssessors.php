<?php

namespace App\Filament\User\Resources\AssessorResource\Pages;

use App\Filament\User\Resources\AssessorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssessors extends ListRecords
{
    protected static string $resource = AssessorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
