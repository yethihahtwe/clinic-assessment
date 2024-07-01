<?php

namespace App\Services\TableComponents;

use stdClass;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;

class TableColumns
{
    protected static function rowNumberColumn() {
        return TextColumn::make('index')
        ->label('No.')
        ->state(
            static function (HasTable $livewire, stdClass $rowLoop): string {
                return (string) (
                    $rowLoop->iteration +
                    ($livewire->getTableRecordsPerPage() * ($livewire->getTablePage() - 1)));
            }
        );
    }

    public static function questionColumns(): array
    {
        return [
            // TextColumn::make('domain.name')->label('Domain')->searchable()->sortable(),
            self::rowNumberColumn(),
            TextColumn::make('subdomain.name')->label('Subdomain')->default('No parent subdomain')->searchable()->sortable(),
            TextColumn::make('name')->label('Question')->searchable()->sortable()->wrap(),
        ];
    }
}
