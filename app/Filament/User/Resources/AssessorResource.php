<?php

namespace App\Filament\User\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Assessor;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\User\Resources\AssessorResource\Pages;
use App\Filament\User\Resources\AssessorResource\RelationManagers;

class AssessorResource extends Resource
{
    protected static ?string $model = Assessor::class;

    protected static ?string $navigationGroup = 'Tools';
protected static ?int $navigationSort = 2;
protected static ?string $navigationIcon = 'heroicon-o-user';

public static function form(Form $form): Form
{
    return $form
        ->schema([
            TextInput::make('name')
                ->label(__('Assessor Name'))
                            ->placeholder('Please enter assessor name')
                ->required()
                ->maxLength(255),
              TextInput::make('position')
                            ->placeholder('Please enter assessor position')
                ->required()
                ->maxLength(255),
                        ])->columns(2);
}
public static function table(Table $table): Table
{
    return $table
        ->query(Assessor::query()->where('organization_id', auth()->user()->organization_id))
        ->columns([
            TextColumn::make('name')->label('Assessor Name')->searchable()->sortable(),
            TextColumn::make('position'),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
}

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAssessors::route('/'),
            'create' => Pages\CreateAssessor::route('/create'),
            'edit' => Pages\EditAssessor::route('/{record}/edit'),
        ];
    }
}
