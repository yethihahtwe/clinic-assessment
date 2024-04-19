<?php

namespace App\Filament\User\Widgets;

use Filament\Tables;
use App\Models\Domain;
use App\Models\Assessment;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\TableWidget as BaseWidget;

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
            // $domainName = strtolower(str_replace([' ', ':', ','], ['_', '', ''], $domain->name));
            $columns[] = TextColumn::make($domainId)->label(new HtmlString($domainName));
        }
        return $table
            ->query($this->getTableQuery())
            ->columns($columns)
            ->defaultSort('date', 'desc');
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

            $query[] = DB::raw("CONCAT($totalScore, ' (', ROUND(($totalScore / $totalPossibleScore) * 100), '%)') AS '$domainId'");
        }

        return Assessment::select($query)
            ->where('organization_id', auth()->user()->organization_id);
    }
}
