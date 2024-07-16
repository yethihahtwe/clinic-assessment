<?php

namespace App\Filament\Resources\PossibleResponseResource\Pages;

use App\Filament\Resources\PossibleResponseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPossibleResponses extends ListRecords
{
    protected static string $resource = PossibleResponseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ImportAction::make()
                ->importer(\App\Filament\Imports\PossibleResponsesImporter::class)
                ->label('Import CSV')
                ->icon(\App\Services\AppIcons::IMPORT_ICON)
                ->visible(fn(): bool => auth()->user()->email === 'admin@ehssg.org'),
        ];
    }
}
