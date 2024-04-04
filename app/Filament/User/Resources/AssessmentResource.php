<?php

namespace App\Filament\User\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Domain;
use Filament\Forms\Form;
use App\Models\Assessment;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Services\AssessmentService;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\User\Resources\AssessmentResource\Pages;
use App\Filament\User\Resources\AssessmentResource\RelationManagers;

class AssessmentResource extends Resource
{
    protected static ?string $model = Assessment::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('clinic_id')
                    ->relationship(name: 'clinic',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn(Builder $query) => $query->where('user_id', auth()->user()->id))
                    ->searchable()
                    ->preload()
                    ->native(false)
                    ->required(),
                Select::make('assessor_id')
                    ->label('Assessment made by')
                    ->relationship(name: 'assessor', titleAttribute: 'name', modifyQueryUsing: fn(Builder $query) => $query->where('user_id', auth()->user()->id))
                    ->searchable()
                    ->preload()
                    ->native(false)
                    ->required(),
                DatePicker::make('date')
                    ->maxDate(now())
                    ->placeholder('Please select assessment date')
                    ->displayFormat('d-M-Y')
                    ->icon('heroicon-o-calendar')
                    ->native(false),
                Section::make('Responses')->schema(AssessmentService::schema()),
                // Section::make('Responses')->schema([
                //     Radio::make('choices.d1q1')->label($domains)->boolean()->inline()->inlineLabel(false)
                //     ])
                    ])->columns(2);
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
            ->actions([Tables\Actions\EditAction::make()])
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
            'index' => Pages\ListAssessments::route('/'),
            'create' => Pages\CreateAssessment::route('/create'),
            'edit' => Pages\EditAssessment::route('/{record}/edit'),
        ];
    }
}
