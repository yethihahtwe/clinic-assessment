<?php

namespace App\Filament\User\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\State;
use App\Models\Clinic;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Township;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\User\Resources\ClinicResource\Pages;
use App\Filament\User\Resources\ClinicResource\RelationManagers;

class ClinicResource extends Resource
{
    protected static ?string $model = Clinic::class;

    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               Select::make('state_id')
	               ->label(__('State/Divison/Province'))
									->placeholder('Please select state')
	               ->options(State::all()->pluck('name', 'id'))
	               ->searchable()
	               ->preload()
	               ->live()
	               ->required()
	               ->native(false)
	               ->afterStateUpdated(function(Set $set)
									{
										$set('township_id', null);
									}),
               Select::make('township_id')
								->label(__('Township'))->placeholder('Please select township')
	               ->options(fn(Get $get): Collection => Township::query()->where('state_id', $get('state_id'))->pluck('name', 'id'))
		               ->searchable()
		               ->preload()
		               ->native(false)
		               ->required(),
		           TextInput::make('name')
				           ->label(__('Clinic Name'))
										->placeholder('Please enter clinic name')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord:true),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
	        ->query(Clinic::query()->where('organization_id', auth()->user()->organization_id))
            ->columns([
                TextColumn::make('name')->label('Clinic')->searchable()->sortable(),
                TextColumn::make('township.name')->label('Township')->searchable()->sortable(),
                TextColumn::make('state.name')->label('State')->searchable()->sortable(),
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
            'index' => Pages\ListClinics::route('/'),
            'create' => Pages\CreateClinic::route('/create'),
            'edit' => Pages\EditClinic::route('/{record}/edit'),
        ];
    }
}
