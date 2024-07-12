<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResponseTypeResource\Pages;
use App\Filament\Resources\ResponseTypeResource\RelationManagers;
use App\Models\ResponseType;
use App\Services\TableComponents\TableColumns;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
}
