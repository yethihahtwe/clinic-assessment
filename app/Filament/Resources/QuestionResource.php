<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Question;
use Filament\Forms\Form;
use App\Models\Subdomain;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\QuestionResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\QuestionResource\RelationManagers;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationGroup = 'Tools';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('domain_id')
                    ->relationship(name: 'domain', titleAttribute: 'name')
                    ->label(__('Parent Domain'))
                    ->placeholder('Please select domain')
                    ->searchable()
                    ->preload()
                    ->live()
                    ->afterStateUpdated(function (Set $set) {
                        $set('subdomain_id', null);
                    })
                    ->native(false)
                    ->required()
                    ->columnSpan(2),
                Select::make('subdomain_id')
                    ->label(__('Parent Subdomain (Leave empty if no subdomain)'))
                    ->placeholder('Select or leave empty')
                    ->options(function (Get $get) {
                        $subdomains = Subdomain::query()->where('domain_id', $get('domain_id'))->pluck('name', 'id');
                        if ($subdomains->isEmpty()) {
                            return collect([null => 'No parent subdomain']);
                        }
                        return $subdomains;
                    })
                    ->searchable()
                    ->preload()
                    ->live()
                    ->native(false)
                    ->default(null)
                    ->columnSpan(2),
                TextInput::make('number')->label(__('Question Number'))->helperText('Please enter the question number from the assessment form')->required()->numeric()->step(1)->columnSpan(1),
                TextArea::make('name')->label(__('Question'))->required()->maxLength(255)->columnSpanFull(),
            ])
            ->columns(5);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([TextColumn::make('domain.name')->label('Domain')->searchable()->sortable(), TextColumn::make('subdomain.name')->label('Subdomain')->default('No parent subdomain')->searchable()->sortable(), TextColumn::make('name')->label('Question')->searchable()->sortable()->wrap()])
            ->filters([SelectFilter::make('domain')->relationship('domain', 'name')->searchable()->preload()->native(false)])
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
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
