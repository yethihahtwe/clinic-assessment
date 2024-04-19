<?php

namespace App\Filament\User\Widgets;

use Filament\Tables;
use App\Models\Domain;
use App\Models\Assessment;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ExportAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Actions\Exports\Enums\ExportFormat;
use App\Filament\Exports\OrganizationScoreExporter;

class AssessmentScores extends BaseWidget
{
    public function table(Table $table): Table
    {
        $domains = Domain::all();
        $columns = [
            TextColumn::make('date')->date('d-M-Y')->sortable(),
            TextColumn::make('clinic.name')->label('Clinic')->searchable()->sortable()
        ];

        foreach ($domains as $domain) {
            $domainId = $domain->id;
            $domainName = str_replace(' ','<br />', $domain->name);
            $columns[] = TextColumn::make($domainId)->label(new HtmlString($domainName));
        }
        return $table
            ->query($this->getTableQuery())
            ->columns($columns)
            ->defaultSort('date', 'desc')
            ->headerActions([
                ExportAction::make()
                    ->icon('heroicon-o-arrow-down-tray')
                    ->label('Download Excel')
                    ->color('primary')
                    ->exporter(OrganizationScoreExporter::class)
                    ->fileName(fn() :string => auth()->user()->organization->abbr . '-' . date('d-M-Y') . '-export')
                    ->columnMapping(false)
                    ->formats([
                        ExportFormat::Xlsx,
                    ])
            ]);
    }

    protected int|string|array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        $query = ['id', 'date', 'clinic_id'];

        $domains = Domain::all();
        foreach ($domains as $domain) {
            $domainId = $domain->id;
            $questions = $domain->questions;
            $totalScore = 0;
            $totalPossibleScore = $questions->count();

            foreach ($questions as $question) {
                $slug = $question->slug;
                $totalScore .= " + IFNULL(CAST(JSON_EXTRACT(choices, '$.$slug') AS SIGNED), 0)";
            }

            $query[] = DB::raw("CONCAT($totalScore, ' (', ROUND((($totalScore) / $totalPossibleScore) * 100), '%)') AS '$domainId'");
        }

        return Assessment::select($query)
            ->where('organization_id', auth()->user()->organization_id);
    }
}
