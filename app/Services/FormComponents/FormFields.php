<?php

namespace App\Services\FormComponents;

use Filament\Forms\Get;
use Illuminate\Support\Str;
use App\Services\AssessmentService;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;

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
                        ->native(false),
                ])
                ->columns(3),
            Tabs::make('Responses')
                ->tabs([
                    Tab::make(static::getDomainName(1))->schema(static::getDomainOneComponents())->columns(2),
                    Tab::make(static::getDomainName(2))->schema(static::getDomainTwoComponents())->columns(2),
                    Tab::make(static::getDomainName(3))->schema(static::getDomainWithSubdomainBooleanOnly(3))->columns(2),
                    Tab::make(static::getDomainName(4))->schema(static::getDomainWithSubdomainBooleanOnly(4))->columns(2),
                    Tab::make(static::getDomainName(5))->schema(static::getDomainWithSubdomainBooleanOnly(5))->columns(2),
                    Tab::make(static::getDomainName(6))->schema(static::getDomainWithSubdomainBooleanOnly(6))->columns(2),
                ])
                ->columnSpanFull()
            // Section::make('Responses')->schema([Tabs::make()->tabs(AssessmentService::schema())]),
        ];
    }

    protected static function getDomainOneComponents(): array
    {
        $questions = \App\Models\Question::where('domain_id', 1)->get();
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
                $questionComponents[] = Radio::make('choices.'. $questionSlug)->label($i . '. ' . $questionLabel)->boolean()->inline()->inlineLabel(false)->live()->columnSpan(1);
                $questionComponents[] = Fieldset::make($questionSlug . '-count')
                ->label($questionLabel . ' count')
                ->schema([
                    self::hrCountInput('m', $questionSlug),
                    self::hrCountInput('f', $questionSlug),
                    self::hrCountInput('o', $questionSlug),
                ])->columnSpan(1)->columns(3)
                ->visible(fn (Get $get) => $get('choices.' . $questionSlug) == 1);
                $i++;
            }
            $subdomainComponents [] = Fieldset::make($subdomainLabel)->schema($questionComponents);

        }
        return $subdomainComponents;
    }

    protected static function getDomainWithSubdomainBooleanOnly($domainId): array
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
                $questionComponents[] = Radio::make('choices.'. $questionSlug)->label($i. '. '. $questionLabel)->boolean()->inline()->inlineLabel(false)->columnSpan(1);
                $i++;
            }
            $subdomainComponents [] = Fieldset::make($subdomainLabel)->schema($questionComponents);
        }
        return $subdomainComponents;
    }


    protected static function getDomainName(int $domainId): string
    {
        return \App\Models\Domain::find($domainId)->name;
    }

    protected static function hrCountInput($g, $questionSlug, ): TextInput
    {
        $label = $g =='m'? 'Male' : ($g == 'f'? 'Female' : 'Other');
        return TextInput::make('choices.' . $questionSlug . '-' . $g)
        ->label($label)
        ->placeholder('Count')
        ->numeric()
        ->default(0)
        ->minValue(0)
        ->suffix('people');
    }
}
