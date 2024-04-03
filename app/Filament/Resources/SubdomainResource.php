<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Subdomain;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SubdomainResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SubdomainResource\RelationManagers;

class SubdomainResource extends Resource
{
    protected static ?string $model = Subdomain::class;
    protected static ?string $navigationGroup = 'Tools';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-document-check';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Select::make('domain_id')
            ->label(__('Domain Name'))
						->placeholder('Please select domain')
		            ->relationship(
								name:'domain',
								titleAttribute: 'name')
								->required()
								->searchable()
								->preload()
								->native(false),
	            TextInput::make('name')
	            ->label(__('Subdomain Name'))
							->placeholder('Please enter subdomain name')
		            ->required()
		            ->maxLength(255),
							])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
	                ->label('Subdomain')
	                ->searchable()->sortable(),
                TextColumn::make('domain.name')
	                ->label('Domain')
	                ->searchable()->sortable(),
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
            'index' => Pages\ListSubdomains::route('/'),
            'create' => Pages\CreateSubdomain::route('/create'),
            'edit' => Pages\EditSubdomain::route('/{record}/edit'),
        ];
    }
}
