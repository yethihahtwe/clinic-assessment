<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PossibleResponseResource\Pages;
use App\Filament\Resources\PossibleResponseResource\RelationManagers;
use App\Models\PossibleResponses;
use App\Services\AppIcons;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PossibleResponseResource extends Resource
{
    protected static ?string $model = PossibleResponses::class;

    protected static ?string $navigationIcon = AppIcons::POSSIBLE_RESPONSE_ICON;

    protected static ?string $navigationGroup = 'Tools';

    protected static ?int $navigationSort = 5;

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
            ->columns([
                //
            ])
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
            'index' => Pages\ListPossibleResponses::route('/'),
            'create' => Pages\CreatePossibleResponse::route('/create'),
            'edit' => Pages\EditPossibleResponse::route('/{record}/edit'),
        ];
    }
}
