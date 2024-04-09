<?php

namespace App\Filament\User\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Domain;
use App\Models\Question;
use Filament\Forms\Form;
use App\Models\Assessment;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use App\Services\AssessmentService;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Radio;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Actions;
use App\Services\AssessmentInfolistService;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\Actions\Action;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Tabs as InfolistTabs;
use App\Filament\User\Resources\AssessmentResource\Pages;
use Filament\Infolists\Components\Section as InfolistSection;
use App\Filament\User\Resources\AssessmentResource\RelationManagers;

class AssessmentResource extends Resource
{
    protected static ?string $model = Assessment::class;

    public ?string $questions = Question::class;

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
	        ->query(Assessment::query()->where('organization_id', auth()->user()->organization_id))
            ->columns([
                TextColumn::make('clinic.name')->label('Clinic')->searchable()->sortable(),
                TextColumn::make('assessor.name')->label('Assessment by')->searchable()->sortable(),
                TextColumn::make('date')->date('d-M-Y')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->modalWidth(MaxWidth::SevenExtraLarge),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }



    public static function infolist(Infolist $infolist):Infolist {
        return $infolist
            ->schema([
                InfolistSection::make()
                    ->schema([
                        Actions::make([
                            Action::make('export')
                                ->url(function (Assessment $record): string
                                {
                                    return route('assessments.export', ['id' => $record->id]);
                                })
                                ->label('Download Excel')
                                ->icon('heroicon-o-arrow-down-tray'),
                        ]),
                        TextEntry::make('clinic.name')->label('Clinic'),
                        TextEntry::make('assessor.name')->label('Assessment made by'),
                        TextEntry::make('date')->date('d-M-Y'),
                        InfolistTabs::make('responses')->tabs(AssessmentInfolistService::schema())->contained(false),
                    ])
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
