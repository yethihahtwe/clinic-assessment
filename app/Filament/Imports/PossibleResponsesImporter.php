<?php

namespace App\Filament\Imports;

use App\Models\PossibleResponses;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class PossibleResponsesImporter extends Importer
{
    protected static ?string $model = PossibleResponses::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('question_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('response')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('score')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
        ];
    }

    public function resolveRecord(): ?PossibleResponses
    {
        // return PossibleResponses::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new PossibleResponses();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your possible responses import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
