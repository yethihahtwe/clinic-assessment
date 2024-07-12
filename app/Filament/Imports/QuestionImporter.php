<?php

namespace App\Filament\Imports;

use App\Models\Question;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class QuestionImporter extends Importer
{
    protected static ?string $model = Question::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('domain')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
            ImportColumn::make('subdomain')
                ->relationship(),
            ImportColumn::make('response_type_id')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
        ];
    }

    public function resolveRecord(): ?Question
    {
        // return Question::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Question();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your question import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
