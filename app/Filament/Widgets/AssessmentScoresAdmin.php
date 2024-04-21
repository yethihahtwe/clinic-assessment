<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\Domain;
use App\Models\Assessment;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Exports\ScoreAdminExporter;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Actions\Exports\Enums\ExportFormat;

class AssessmentScoresAdmin extends BaseWidget
{
    public function table(Table $table): Table
    {
        $domains = Domain::all();
        $columns = [TextColumn::make('date')->date('d-M-Y')->sortable(), TextColumn::make('clinic.name')->label('Clinic')->searchable()->sortable(), TextColumn::make('organization.abbr')->label('Organization')->searchable()->sortable()];

        foreach ($domains as $domain) {
            $domainId = $domain->id;
            $domainName = str_replace(' ', '<br />', $domain->name);
            $columns[] = TextColumn::make($domainId)->label(new HtmlString($domainName));
        }
        return $table
            ->query($this->getTableQuery())
            ->columns($columns)
            ->defaultSort('date', 'desc')
            ->filters([SelectFilter::make('organization')->relationship('organization', 'abbr')->searchable()->preload()->native(false),])
            ->headerActions([
                ExportAction::make()
                    ->icon('heroicon-o-arrow-down-tray')
                    ->label('Download Excel')
                    ->color('primary')
                    ->exporter(ScoreAdminExporter::class)
                    ->fileName(fn() :string => date('d-M-Y') . '-admin-export')
                    ->columnMapping(false)
                    ->formats([ExportFormat::Xlsx])
            ]);
    }

    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 6;

    protected function getTableQuery(): Builder
    {
        $query = ['id', 'date', 'clinic_id', 'organization_id'];

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

        return Assessment::select($query);
    }
}
