<?php

namespace App\Filament\Resources\QuestionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TextResponsesRelationManager extends RelationManager
{
    protected static string $relationship = 'textResponses';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('response_label')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_numeric')
                    ->label('Is Numeric?')
                    ->default(false),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('response_label')
            ->columns([
                Tables\Columns\TextColumn::make('response_label'),
                Tables\Columns\TextColumn::make('is_numeric')
                    ->label('Is Numeric?')
                    ->formatStateUsing(fn($state): string => $state? 'Yes' : 'No'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
