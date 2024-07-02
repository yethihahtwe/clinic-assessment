<?php

namespace App\Services;

use App\Models\Domain;
use Filament\Forms\Get;
use App\Models\Question;
use App\Models\Subdomain;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Radio;
use App\Services\Options\CustomArrays;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use App\Services\CustomFunctions\CustomFunctions;

class AssessmentService
{
    public static function schema(): array
    {
        $domains = Domain::all();
        $domainComponents = [];

        foreach ($domains as $domain) {
            $domainLabel = $domain->name;
            $subdomains = Subdomain::where('domain_id', $domain->id)->get();

            $hasSubdomains = $subdomains->isNotEmpty();

            $subdomainComponents = [];
            if ($hasSubdomains) {
                foreach ($subdomains as $subdomain) {
                    $subdomainLabel = $subdomain->name;

                    $questions = Question::where('subdomain_id', $subdomain->id)->get();
                    $questionComponents = [];
                    $i = 1;
                    foreach ($questions as $question) {
                        $questionLabel = $question->name;
                        $questionSlug = $question->slug;
                        $isRequiredMoreTextInput = in_array($questionSlug, CustomArrays::$isRequiredMoreTextInputFields);

                        $questionComponents[] = Radio::make('choices.' . $questionSlug)
                            ->label($i . '. ' . $questionLabel)
                            ->boolean()
                            ->inline()
                            ->inlineLabel(false)
                            ->live($isRequiredMoreTextInput);

                        if ($isRequiredMoreTextInput) {
                            $questionComponents[] =
                                Group::make([
                                    TextInput::make('choices.' . $questionSlug . '.m')
                                        ->label('Male')
                                        ->numeric()
                                        ->step(1)
                                        ->minValue(0)
                                        ->suffix('person(s)')
                                        ->visible(fn (Get $get) => $get('choices.' . $questionSlug) == 1),
                                    TextInput::make('choices.' . $questionSlug . '.f')
                                        ->label('Female')
                                        ->numeric()
                                        ->step(1)
                                        ->minValue(0)
                                        ->suffix('person(s)')
                                        ->visible(fn (Get $get) => $get('choices.' . $questionSlug) == 1),
                                    TextInput::make('choices.' . $questionSlug . '.o')
                                        ->label('Other')
                                        ->numeric()
                                        ->step(1)
                                        ->minValue(0)
                                        ->suffix('person(s)')
                                        ->visible(fn (Get $get) => $get('choices.' . $questionSlug) == 1),
                                ])->columns(3);
                        }
                        $i++;
                    }
                    $subdomainComponents[] = Fieldset::make($subdomainLabel)->schema($questionComponents)->columns(2);
                }
                $domainComponents[] = Tab::make($domainLabel)->schema($subdomainComponents);
            } else {
                $questions = Question::where('domain_id', $domain->id)->get();
                $questionComponents = [];
                $i = 1;
                foreach ($questions as $question) {
                    $questionLabel = $question->name;
                    $questionSlug = $question->slug;
                    $questionComponents[] = Radio::make('choices.' . $questionSlug)->label($i . '. ' . $questionLabel)->boolean()->inline()->inlineLabel(false);
                    $i++;
                }
                $domainComponents[] = Tab::make($domainLabel)->schema($questionComponents)->columns(2);
            }
        }
        return $domainComponents;
    }
}
