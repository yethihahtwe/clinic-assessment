<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Domain;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DomainResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DomainResource\RelationManagers;

class DomainResource extends Resource
{
    protected static ?string $model = Domain::class;
    protected static ?string $navigationGroup = 'Tools';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-check-badge';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
	            TextInput::make('name')
	            ->label(__('Domain Name'))
	            ->placeholder('Please enter domain name')
		            ->required()
		            ->maxLength(255),
							])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Domain')->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListDomains::route('/'),
            'create' => Pages\CreateDomain::route('/create'),
            'edit' => Pages\EditDomain::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        if (Auth::user()->email === 'admin@ehssg.org')
        {
	        return true;
        }
        else
        {
	        return false;
        }
    }
}
