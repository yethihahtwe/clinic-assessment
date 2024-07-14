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
                ->tabs(
                    self::getDomainComponents()
                )
                ->columnSpanFull()
        ];
    }

    /*
    If a domain has subdomains, questions need to wrap with subdomains.
    If not questions will follow a domain.
    If no subdomains, question query filtered by domain_id.
    If has subdomains, question query filtered by subdomain_id.
     */
    protected static function getQuestionComponents($idType, $id): array
    {
        // query questions based on domain or subdomain
        if ($idType === 'domain') {
            $questions = \App\Models\Question::where('domain_id', $id)->get();
        } else if ($idType === 'subdomain') {
            $questions = \App\Models\Question::where('subdomain_id', $id)->get();
        }

        $questionComponents = [];
        $i = 1;
        foreach ($questions as $question) {
            $questionId = $question->id;
            $questionLabel = $question->name;
            $responseType = $question->response_type_id;
            $possibleResponses = \App\Models\PossibleResponses::where('question_id', $questionId)->get();
            if ($responseType == 1) { // accepting only text input
                $textResponses = \App\Models\TextResponse::where('question_id', $questionId)->get();
                if ($textResponses->count() > 0) {
                    foreach ($textResponses as $textResponse) {
                        $questionComponents[] = TextInput::make('choices.' . $questionId)
                            ->label($i . '. ' . $textResponse->response_label)
                            ->placeholder('Enter response');
                        $i++;
                    }
                }
            } else if ($responseType == 2) { // accepting only single select
                if ($possibleResponses->count() > 0) {
                    $questionComponents[] = Radio::make('choices.' . $questionId)
                        ->label($i . '. ' . $questionLabel)
                        ->options($possibleResponses->pluck('response', 'response'))
                        ->inline()
                        ->inlineLabel(false);
                    $i++;
                }
            } else if ($responseType == 3) { // accepting multiple select
                if ($possibleResponses->count() > 0) {
                    $questionComponents[] = CheckboxList::make('choices.' . $questionId)
                        ->label($i . '. ' . $questionLabel . ' (တစ်ခုထက်ပို၍ဖြေဆိုနိုင်ပါသည်)')
                        ->options($possibleResponses->pluck('response', 'response'))
                        ->columns(2);
                    $i++;
                }
            } else if ($responseType == 4) { // accepting single select and single text input
                $textResponse = \App\Models\TextResponse::where('question_id', $questionId)->first();
                if (!empty($textResponse)) {
                    $questionComponents[] = Radio::make('choices.' . $questionId)
                        ->label($i . '. ' . $questionLabel)
                        ->boolean()
                        ->inline()
                        ->inlineLabel(false)
                        ->live();
                    $questionComponents[] = TextInput::make('choices.' . $questionId . '.' . $textResponse->response_label)
                        ->label($textResponse->response_label)
                        ->disabled(fn (Get $get): bool => $get('choices.' . $questionId) != 1)
                        ->dehydrated(fn (Get $get): bool => $get('choices.' . $questionId) == 1);
                }
                $i++;
            } else if ($responseType == 5) { // accepting single select and multiple text input
                if ($possibleResponses->count() > 0) {
                    $questionComponents[] = Radio::make('choices.' . $questionId)
                        ->label($i . '. ' . $questionLabel)
                        ->options($possibleResponses->pluck('response', 'score'))
                        ->inline()
                        ->inlineLabel(false)
                        ->live()
                        ->afterStateUpdated(function(Set $set, Get $get) use ($questionId): void {
                            $keys = collect($get('choices'))->keys()->filter(fn ($key) => Str::startsWith($key, $questionId. '_'));
                            foreach ($keys as $key) {
                                $set('choices.' . $key, 0);
                            }
                        });
                    $textResponses = \App\Models\TextResponse::where('question_id', $questionId)->get();
                    if ($textResponses->count() > 0) {
                        $textComponents = [];
                        foreach ($textResponses as $textResponse) {
                            $textComponents[] = TextInput::make('choices.' . $questionId . '_' . $textResponse->response_label)
                                ->label($textResponse->response_label)
                                ->numeric($textResponse->is_numeric)
                                ->required()
                                ->default(0)
                                ->minValue(0)
                                ->disabled(fn (Get $get): bool => $get('choices.' . $questionId) != 1)
                                ->dehydrated(true)
                                // ->dehydrated(fn (Get $get): bool => $get('choices.' . $questionId) == 1)
                                ;
                        }
                        $questionComponents[] = Group::make($textComponents)
                            ->columns(3)
                            ->columnSpan(1);
                    }
                }
                $i++;
            }
        }
        return $questionComponents;
    }

    protected static function getDomainComponents(): array
    {
        $domains = \App\Models\Domain::all();
        $domainComponents = [];
        foreach ($domains as $domain) {
            $domainId = $domain->id;
            $domainName = $domain->name;
            $domainComponents[] = Tab::make($domainName)
                ->schema(self::getSubdomainComponents($domainId))
                ->columns(2);
        }
        return $domainComponents;
    }

    protected static function getSubdomainComponents($domainId): array
    {
        $subdomains = \App\Models\Subdomain::where('domain_id', $domainId)->get();
        $hasSubdomain = $subdomains->count() > 0;
        if ($hasSubdomain) {
            $subdomainComponents = [];
            foreach ($subdomains as $subdomain) {
                $subdomainId = $subdomain->id;
                $subdomainName = $subdomain->name;
                $subdomainComponents[] = Section::make($subdomainName)
                    ->label($subdomainName)
                    ->schema(self::getQuestionComponents('subdomain', $subdomainId))
                    ->columns(2);
            }
            return $subdomainComponents;
        }
        return self::getQuestionComponents('domain', $domainId);
    }
}
