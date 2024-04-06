<?php

namespace App\Filament\User\Widgets;

use Filament\Tables;
use App\Models\Assessment;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\TableWidget as BaseWidget;

// class AssessmentScores extends BaseWidget
// {
//     public function table(Table $table): Table
//     {
//         return $table
//             ->query($this->getTableQuery())
//             ->columns([
//                 TextColumn::make('date')->date('d-M-Y')->sortable(),
//                 TextColumn::make('clinic.name')->label('Clinic')->searchable()->sortable(),
//                 TextColumn::make('choices'),
//             ]);
//     }

//     protected int | string | array $columnSpan = 'full';

//     protected function getTableQuery(): Builder{
//         return Assessment::select(
//             DB::raw('MIN(id) as id'),
//             DB::raw('date'),
//             DB::raw('clinic_id'),
//             DB::raw('choices'),
//         );
//     }

// }
