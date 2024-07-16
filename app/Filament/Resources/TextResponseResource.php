<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Services\AppIcons;
use Filament\Tables\Table;
use App\Models\TextResponse;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TextResponseResource\Pages;
use App\Filament\Resources\TextResponseResource\RelationManagers;

class TextResponseResource extends Resource
{
    protected static ?string $model = TextResponse::class;

    protected static ?string $navigationIcon = \App\Services\AppIcons::TEXT_RESPONSE_ICON;

    protected static ?string $navigationGroup = 'Tools';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('question_id')
                    ->required()
                    ->numeric(),
                Forms\Components\Textarea::make('response_label')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_numeric')
                    ->label('Is Numeric?')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('response_label')
                    ->label('Response Label')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('is_numeric')
                    ->label('Is Numeric?')
                    ->formatStateUsing(fn($state): string => $state? 'Yes' : 'No'),
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
            'index' => Pages\ListTextResponses::route('/'),
            'create' => Pages\CreateTextResponse::route('/create'),
            'edit' => Pages\EditTextResponse::route('/{record}/edit'),
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
