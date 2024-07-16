<?php

namespace App\Filament\Resources\QuestionResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\QuestionResource;
use App\Services\TableComponents\TableTabs;

class ListQuestions extends ListRecords
{
    protected static string $resource = QuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ImportAction::make()
                ->importer(\App\Filament\Imports\QuestionImporter::class)
                ->label('Import CSV')
                ->icon(\App\Services\AppIcons::IMPORT_ICON)
                ->visible(fn(): bool => auth()->user()->email === 'admin@ehssg.org'),
        ];
    }

    public function getTabs(): array
    {
        return TableTabs::domainTabs();
    }
}
