<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ResponseType;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Services\TableComponents\TableColumns;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ResponseTypeResource\Pages;
use App\Filament\Resources\ResponseTypeResource\RelationManagers;

class ResponseTypeResource extends Resource
{
    protected static ?string $model = ResponseType::class;

    protected static ?string $navigationIcon = \App\Services\AppIcons::RESPONSE_TYPE_ICON;

    protected static ?string $navigationGroup = 'Tools';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(TableColumns::responseTypeColumns())
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListResponseTypes::route('/'),
            'create' => Pages\CreateResponseType::route('/create'),
            'edit' => Pages\EditResponseType::route('/{record}/edit'),
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
