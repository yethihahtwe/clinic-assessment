<?php

namespace App\Services\TableComponents;

use stdClass;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;

class TableColumns
{
    public static function rowNumberColumn()
    {
        return TextColumn::make('index')
            ->label('No.')
            ->rowIndex();
    }

    public static function domainColumns(): array
    {
        return [
            self::rowNumberColumn(),
            TextColumn::make('name')->label('Domain')->searchable()->sortable(),
        ];
    }

    public static function subdomainColumns(): array
    {
        return [
            self::rowNumberColumn(),
            TextColumn::make('name')
                ->label('Subdomain')
                ->searchable()->sortable(),
        ];
    }

    public static function questionColumns(): array
    {
        return [
            // TextColumn::make('domain.name')->label('Domain')->searchable()->sortable(),
            self::rowNumberColumn(),
            TextColumn::make('subdomain.name')->label('Subdomain')->default('No parent subdomain')->searchable()->sortable(),
            TextColumn::make('name')->label('Question')->searchable()->sortable()->wrap(),
            TextColumn::make('responseType.name')->label('Response Type')->formatStateUsing(fn($state): string => ucfirst($state))->searchable()->sortable(),
        ];
    }

    public static function responseTypeColumns(): array
    {
        return [
            self::rowNumberColumn(),
            TextColumn::make('name')->label('Response Type')->searchable()->sortable(),
        ];
    }
}
