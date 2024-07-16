<?php

namespace App\Filament\Resources\DomainResource\Pages;

use App\Filament\Resources\DomainResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDomains extends ListRecords
{
    protected static string $resource = DomainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ImportAction::make()
                ->importer(\App\Filament\Imports\DomainImporter::class)
                ->label('Import CSV')
                ->icon(\App\Services\AppIcons::IMPORT_ICON)
                ->visible(fn(): bool => auth()->user()->is_admin),
        ];
    }
}
