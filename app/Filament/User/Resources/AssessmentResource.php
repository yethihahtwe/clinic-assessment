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
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
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
                        modifyQueryUsing: fn(Builder $query) => $query->where('organization_id', auth()->user()->organization_id))
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
                Section::make('Responses')->schema([Tabs::make('Responses')->tabs(AssessmentService::schema())]),
                    ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
	        ->query(Assessment::query()->where('user_id', auth()->user()->id))
            ->columns([
                TextColumn::make('clinic.name')->label('Clinic')->searchable()->sortable(),
                TextColumn::make('assessor.name')->label('Assessment by')->searchable()->sortable(),
                TextColumn::make('date')->date('d-M-Y')->sortable(),
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
            'index' => Pages\ListAssessments::route('/'),
            'create' => Pages\CreateAssessment::route('/create'),
            'edit' => Pages\EditAssessment::route('/{record}/edit'),
        ];
    }
}
