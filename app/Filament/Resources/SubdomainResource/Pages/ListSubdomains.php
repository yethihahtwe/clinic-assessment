<?php

namespace App\Filament\Resources\SubdomainResource\Pages;

use App\Filament\Resources\SubdomainResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Services\TableComponents\TableTabs;

class ListSubdomains extends ListRecords
{
    protected static string $resource = SubdomainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ImportAction::make()
                ->importer(\App\Filament\Imports\SubdomainImporter::class)
                ->label('Import CSV')
                ->icon(\App\Services\AppIcons::IMPORT_ICON),
        ];
    }

    public function getTabs(): array
    {
        return TableTabs::domainTabs();
    }
}
