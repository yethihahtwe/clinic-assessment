<?php

namespace App\Filament\Imports;

use App\Models\Subdomain;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class SubdomainImporter extends Importer
{
    protected static ?string $model = Subdomain::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('domain')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
        ];
    }

    public function resolveRecord(): ?Subdomain
    {
        // return Subdomain::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Subdomain();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your subdomain import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
