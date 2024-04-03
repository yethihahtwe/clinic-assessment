<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Township;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TownshipResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TownshipResource\RelationManagers;

class TownshipResource extends Resource
{
    protected static ?string $model = Township::class;
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationIcon = 'heroicon-o-map';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
	            Select::make('state_id')
	            ->label(__('State/Division/Province'))
	            ->placeholder('Please select')
		            ->relationship(
								name:'state',
								titleAttribute: 'name')
								->searchable()
								->preload()
								->required()
								->native(false),
	            TextInput::make('name')
	            ->label(__('Township Name'))
	            ->placeholder('Please enter township name')
		            ->required()
		            ->maxLength(255),
							])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([TextColumn::make('name')->searchable()->sortable(), TextColumn::make('state.name')->searchable()->sortable()])
            ->filters([
                //
            ])
            ->actions([Tables\Actions\ViewAction::make(), Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
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
            'index' => Pages\ListTownships::route('/'),
            'create' => Pages\CreateTownship::route('/create'),
            'edit' => Pages\EditTownship::route('/{record}/edit'),
        ];
    }
}
