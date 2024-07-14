<?php

namespace App\Filament\Imports;

use App\Models\TextResponse;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class TextResponseImporter extends Importer
{
    protected static ?string $model = TextResponse::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('question_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('response_label')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('is_numeric')
            ->requiredMapping()
            ->numeric()
            ->rules(['required', 'integer']),
        ];
    }

    public function resolveRecord(): ?TextResponse
    {
        // return TextResponse::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new TextResponse();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your text response import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
