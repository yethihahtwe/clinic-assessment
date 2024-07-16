<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Assessment;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Infolists\Components\Tabs;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Section;
use App\Services\AssessmentInfolistService;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Actions\Action;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AssessmentResource\Pages;
use App\Filament\Resources\AssessmentResource\RelationManagers;

class AssessmentResource extends Resource
{
    protected static ?string $model = Assessment::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

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
            ->modifyQueryUsing(function (Builder $query) {
                return $query->orderBy('date', 'desc');
            })
            ->columns([
                \Filament\Tables\Columns\Layout\Stack::make([
                    TextColumn::make('clinic.name')->label('Clinic')->searchable()->sortable(),
                    TextColumn::make('assessor.name')->label('Assessment by')->searchable()->sortable(),
                    TextColumn::make('date')->date('d-M-Y')->sortable(),
                    TextColumn::make('organization.abbr')->label('Organization')->badge()->searchable()->sortable(),
                ])
            ])
            ->contentGrid([
                'md' => 3,
                'xl' => 5,
            ])
            ->filters([
                \Filament\Tables\Filters\Filter::make('organization')
                    ->form([
                        \Filament\Forms\Components\Select::make('organization_id')
                            ->label('Organization')
                            ->placeholder('Filter by organization')
                            ->options(\App\Models\Organization::all()->pluck('abbr', 'id'))
                            ->native(false)
                            ->searchable()
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['organization_id'],
                                fn (Builder $query, $organization): Builder => $query->where('organization_id', $organization)
                            );
                    })
            ], layout: \Filament\Tables\Enums\FiltersLayout::AboveContent)
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
                Section::make()
                    ->schema([
                        \Filament\Infolists\Components\Group::make([
                            TextEntry::make('clinic.name')->label('Clinic')->badge(),
                            TextEntry::make('assessor.name')->label('Assessment made by')->badge(),
                            TextEntry::make('date')->date('d-M-Y')->badge(),
                            TextEntry::make('organization.abbr')->label('Organization')->badge()->visible(fn(): bool => auth()->user()->is_admin),
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
                        Tabs::make('responses')->tabs(AssessmentInfolistService::schema())->contained(false)->columnSpanFull(),
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
