<?php

namespace App\Services;

use App\Models\Domain;
use App\Models\Question;
use App\Models\Subdomain;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Tabs\Tab;

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
                    foreach($questions as $question){
                        $questionLabel = $question->name;
                        $questionSlug = $question->slug;
                        $questionComponents[] = Radio::make('choices.'. $questionSlug)->label($i .'. '. $questionLabel)->boolean()->inline()->inlineLabel(false);
                        $i++;
                    }
                    $subdomainComponents[] = Fieldset::make($subdomainLabel)->schema($questionComponents)->columns(1);
                }
                $domainComponents[] = Tab::make($domainLabel)->schema($subdomainComponents);
            } else {
                $questions = Question::where('domain_id', $domain->id)->get();
                $questionComponents = [];
                $i = 1;
                foreach($questions as $question){
                    $questionLabel = $question->name;
                    $questionSlug = $question->slug;
                    $questionComponents[] = Radio::make('choices.'. $questionSlug)->label($i . '. '. $questionLabel)->boolean()->inline()->inlineLabel(false);
                    $i++;
                }
                $domainComponents[] = Tab::make($domainLabel)->schema($questionComponents)->columns(1);
            }
        }
        return $domainComponents;
    }
}
