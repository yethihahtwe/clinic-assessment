<?php

namespace App\Filament\Resources\ResponseTypeResource\Pages;

use App\Filament\Resources\ResponseTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListResponseTypes extends ListRecords
{
    protected static string $resource = ResponseTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ImportAction::make()
                ->importer(\App\Filament\Imports\ResponseTypeImporter::class)
                ->label('Import CSV')
                ->icon(\App\Services\AppIcons::IMPORT_ICON)
                ->visible(fn(): bool => auth()->user()->is_admin),
        ];
    }
}
