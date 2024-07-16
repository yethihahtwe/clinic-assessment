<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Services\AppIcons;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\PossibleResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Services\TableComponents\TableColumns;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PossibleResponseResource\Pages;
use App\Filament\Resources\PossibleResponseResource\RelationManagers;

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
            ->columns(TableColumns::possibleResponseColumns())
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
