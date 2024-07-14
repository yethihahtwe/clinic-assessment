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
use App\Services\FormComponents\FormFields;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Actions\Action;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Tabs as InfolistTabs;
use App\Filament\User\Resources\AssessmentResource\Pages;
use Filament\Infolists\Components\Section as InfolistSection;
use App\Filament\User\Resources\AssessmentResource\RelationManagers;
use Illuminate\Contracts\Support\Htmlable;

class AssessmentResource extends Resource
{
    protected static ?string $model = Assessment::class;

    public ?string $questions = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(FormFields::assessmentFormFields())->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Assessment::query()->where('organization_id', auth()->user()->organization_id))
            ->columns([
                \Filament\Tables\Columns\Layout\Stack::make([
                    TextColumn::make('clinic.name')->label('Clinic')->searchable()->sortable(),
                    TextColumn::make('assessor.name')->label('Assessment by')->searchable()->sortable(),
                    TextColumn::make('date')->date('d-M-Y')->sortable(),
                ])
            ])
            ->contentGrid([
                'md' => 3,
                'xl' => 5,
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
            ])
            ->recordUrl(null);
    }



    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistSection::make()
                    ->schema([
                        \Filament\Infolists\Components\Group::make([
                            TextEntry::make('clinic.name')->label('Clinic')->badge(),
                            TextEntry::make('assessor.name')->label('Assessment made by')->badge(),
                            TextEntry::make('date')->date('d-M-Y')->badge(),
                        ])
                            ->columns(3)->columnSpan(1),
                        Actions::make([
                            Action::make('export')
                                ->url(function (Assessment $record): string {
                                    return route('assessments.export', ['id' => $record->id]);
                                })
                                ->label('Download Excel')
                                ->icon('heroicon-o-arrow-down-tray'),
                        ]),
                        InfolistTabs::make('responses')->tabs(AssessmentInfolistService::schema())->contained(false)->columnSpanFull(),
                    ])->columns(2),
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
