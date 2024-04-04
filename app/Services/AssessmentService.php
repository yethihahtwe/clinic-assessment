<?php

namespace App\Services;

use App\Models\Domain;
use App\Models\Question;
use App\Models\Subdomain;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;

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
                    foreach($questions as $question){
                        $questionLabel = $question->name;
                        $questionComponents[] = Radio::make('choices')->label($questionLabel)->boolean()->inline()->inlineLabel(false);
                    }
                    $subdomainComponents[] = Fieldset::make($subdomainLabel)->schema($questionComponents);
                }
                $domainComponents[] = Section::make($domainLabel)->schema($subdomainComponents);
            } else {
                $questions = Question::where('domain_id', $domain->id)->get();
                $questionComponents = [];
                foreach($questions as $question){
                    $questionLabel = $question->name;
                    $questionComponents[] = Radio::make('choices')->label($questionLabel)->boolean()->inline()->inlineLabel(false);
                }
                $domainComponents[] = Section::make($domainLabel)->schema($questionComponents);
            }
        }
        return $domainComponents;
    }
}
