<?php

namespace App\Filament\Resources\TextResponseResource\Pages;

use App\Filament\Resources\TextResponseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTextResponses extends ListRecords
{
    protected static string $resource = TextResponseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ImportAction::make()
                ->importer(\App\Filament\Imports\TextResponseImporter::class)
                ->label('Import CSV')
                ->icon(\App\Services\AppIcons::IMPORT_ICON)
                ->visible(fn(): bool => auth()->user()->email === 'admin@ehssg.org'),
        ];
    }
}
