<?php

namespace App\Services\FormComponents;

use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use App\Services\AssessmentService;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use App\Services\Options\SelectOptions;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\CheckboxList;

class FormFields
{
    public static function assessmentFormFields(): array
    {
        return [
            Section::make('Assessment')
                ->schema([
                    Select::make('clinic_id')
                        ->placeholder('Please select clinic')
                        ->relationship(
                            name: 'clinic',
                            titleAttribute: 'name',
                            modifyQueryUsing: fn (Builder $query) => $query->where('organization_id', auth()->user()->organization_id)
                        )
                        ->searchable()
                        ->preload()
                        ->native(false)
                        ->required(),
                    Select::make('assessor_id')
                        ->label('Assessment made by')
                        ->placeholder('Please select assessor')
                        ->relationship(name: 'assessor', titleAttribute: 'name', modifyQueryUsing: fn (Builder $query) => $query->where('organization_id', auth()->user()->organization_id))
                        ->searchable()
                        ->preload()
                        ->native(false)
                        ->required(),
                    DatePicker::make('date')
                        ->required()
                        ->maxDate(now())
                        ->placeholder('Please select assessment date')
                        ->displayFormat('d-M-Y')
                        ->icon('heroicon-o-calendar')
                        ->native(false)
                        ->closeOnDateSelection(),
                ])
                ->columns(3),
            Tabs::make('Responses')
                ->tabs([
                    Tab::make(static::getDomainName(1))->schema(static::getDomainWithoutSubdomainComponents(1))->columns(2),
                    Tab::make(static::getDomainName(2))->schema(static::getDomainTwoComponents())->columns(2),
                    Tab::make(static::getDomainName(3))->schema(static::getDomainWithSubdomain(3))->columns(2),
                    Tab::make(static::getDomainName(4))->schema(static::getDomainWithSubdomain(4))->columns(2),
                    Tab::make(static::getDomainName(5))->schema(static::getDomainWithSubdomain(5))->columns(2),
                    Tab::make(static::getDomainName(6))->schema(static::getDomainWithSubdomain(6))->columns(2),
                    Tab::make(static::getDomainName(7))->schema(static::getDomainWithSubdomain(7))->columns(2),
                    Tab::make(static::getDomainName(8))->schema(static::getDomainWithSubdomain(8))->columns(2),
                    Tab::make(static::getDomainName(9))->schema(static::getDomainWithoutSubdomainComponents(9))->columns(2),
                    Tab::make(static::getDomainName(10))->schema(static::getDomainWithSubdomain(10))->columns(2),
                ])
                ->columnSpanFull()
            // Section::make('Responses')->schema([Tabs::make()->tabs(AssessmentService::schema())]),
        ];
    }

    protected static function getDomainWithoutSubdomainComponents($domainId): array
    {
        $questions = \App\Models\Question::where('domain_id', $domainId)->get();
        $questionComponents = [];
        $i = 1;
        foreach ($questions as $question) {
            $questionLabel = $question->name;
            $questionSlug = $question->slug;
            $questionComponents[] = Radio::make('choices.' . $questionSlug)->label($i . '. ' . $questionLabel)->boolean()->inline()->inlineLabel(false);
            $i++;
        }
        return $questionComponents;
    }

    protected static function getDomainTwoComponents(): array
    {
        // return [
        //     Fieldset::make('man-power')
        //         ->label('Man Power')
        //         ->schema([
        //             Radio::make('choices.d2q1')
        //                 ->label('1. Doctors')
        //                 ->boolean()
        //                 ->inline()
        //                 ->inlineLabel(false)
        //                 ->live()
        //                 ->afterStateUpdated(function (Set $set) {
        //                     $set('choices.d2q1-m', 0);
        //                     $set('choices.d2q1-f', 0);
        //                     $set('choices.d2q1-o', 0);
        //                 })
        //                 ->columnSpan(1),
        //             Fieldset::make('d2q1-count')
        //                 ->label('Doctors count')
        //                 ->schema([
        //                     TextInput::make('choices.d2q1-m')

        //                 ->disabled(fn (Get $get) => $get('choices.d2q1') != 1)
        //                         ->label('Male')
        //                         ->placeholder('Count')
        //                         ->numeric()
        //                         ->default(0)
        //                         ->minValue(0)
        //                         ->suffix('people'),
        //                 ])->columnSpan(1)->columns(3),

        //         ]),
        // ];
        $subdomains = \App\Models\Subdomain::where('domain_id', 2)->get();
        $subdomainComponents = [];
        foreach ($subdomains as $subdomain) {
            $subdomainId = $subdomain->id;
            $subdomainLabel = $subdomain->name;

            $questions = \App\Models\Question::where('subdomain_id', $subdomainId)->get();
            $questionComponents = [];
            $i = 1;
            foreach ($questions as $question) {
                $questionLabel = $question->name;
                $questionSlug = $question->slug;
                $questionComponents[] = Radio::make('choices.' . $questionSlug)
                ->label($i . '. ' . $questionLabel)
                ->boolean()
                ->inline()
                ->inlineLabel(false)
                ->live()
                ->afterStateUpdated(function(Set $set) use ($questionSlug){
                    $set('choices.' . $questionSlug . '-m', 0);
                    $set('choices.'. $questionSlug. '-f', 0);
                    $set('choices.'. $questionSlug. '-o', 0);
                })
                ->columnSpan(1);
                $questionComponents[] = Fieldset::make($questionSlug . '-count')
                    ->label($questionLabel . ' count')
                    ->schema([
                        self::hrCountInput('m', $questionSlug),
                        self::hrCountInput('f', $questionSlug),
                        self::hrCountInput('o', $questionSlug),
                    ])->columnSpan(1)->columns(3)
                    ->disabled(fn (Get $get) => $get('choices.' . $questionSlug) != 1);
                $i++;
            }
            $subdomainComponents[] = Fieldset::make($subdomainLabel)->schema($questionComponents);
        }
        return $subdomainComponents;
    }

    protected static function getDomainWithSubdomain($domainId): array
    {
        $subdomains = \App\Models\Subdomain::where('domain_id', $domainId)->get();
        $subdomainComponents = [];
        foreach ($subdomains as $subdomain) {
            $subdomainId = $subdomain->id;
            $subdomainLabel = $subdomain->name;

            $questions = \App\Models\Question::where('subdomain_id', $subdomainId)->get();
            $questionComponents = [];
            $i = 1;
            foreach ($questions as $question) {
                $questionLabel = $question->name;
                $questionSlug = $question->slug;
                $isMultiselect = $question->is_multiselect;
                if ($isMultiselect) {
                    $questionComponents[] = CheckboxList::make('choices.' . $questionSlug)
                        ->label($i . '. ' . $questionLabel)
                        ->options(SelectOptions::${$questionSlug})
                        ->columns(2);
                } else {
                    if (!in_array($questionSlug, ['d8q33', 'd8q34', 'd8q35'])) {
                        $questionComponents[] =
                            Radio::make('choices.' . $questionSlug)
                            ->label($i . '. ' . $questionLabel)
                            ->boolean()
                            ->inline()
                            ->inlineLabel(false)
                            ->columnSpan(1);
                    } else {
                        $questionComponents[] =
                            Radio::make('choices.' . $questionSlug)
                            ->label($i . '. ' . $questionLabel)
                            ->options(SelectOptions::${$questionSlug})
                            ->inline()
                            ->inlineLabel(false)
                            ->columnSpan(1);
                    }
                }
                $i++;
            }
            $subdomainComponents[] = Fieldset::make($subdomainLabel)->schema($questionComponents);
        }
        return $subdomainComponents;
    }


    protected static function getDomainName(int $domainId): string
    {
        return \App\Models\Domain::find($domainId)->name;
    }

    protected static function hrCountInput($g, $questionSlug,): TextInput
    {
        $label = $g == 'm' ? 'Male' : ($g == 'f' ? 'Female' : 'Other');
        return TextInput::make('choices.' . $questionSlug . '-' . $g)
            ->label($label)
            ->placeholder('Count')
            ->numeric()
            ->default(0)
            ->minValue(0)
            ->suffix('people');
    }
}
