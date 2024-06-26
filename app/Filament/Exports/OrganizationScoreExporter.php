<?php

namespace App\Filament\Exports;

use App\Models\Domain;
use App\Models\OrganizationScore;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Models\Export;

class OrganizationScoreExporter extends Exporter
{
    protected static ?string $model = OrganizationScore::class;

    public static function getColumns(): array
    {
            $domains = Domain::all();
            $columns = [
                ExportColumn::make('date'),
                ExportColumn::make('clinic.name')->label('Clinic'),
            ];

            foreach($domains as $domain)
            {
                $domainId = $domain->id;
                $domainName = $domain->name;
                $columns[] = ExportColumn::make($domainId)->label($domainName);
            }
        return $columns;
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your organization score export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
