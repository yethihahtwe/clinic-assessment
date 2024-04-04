<?php

namespace App\Services;

use App\Models\Domain;
use App\Models\Subdomain;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;

class AssessmentService {
	public static function schema():array{
		$domains = Domain::all();
        $domainComponents = [];

        $subdomains = [];
        $subdomainComponents = [];
		foreach($domains as $domain){
            $domainLabel = $domain->name;
            $subdomains[] = Subdomain::where('domain_id', $domain->id)->get();
            foreach($subdomains as $subdomain){
                foreach($subdomain as $subdomainName){
                    $subdomainLabel = $subdomainName->name;
                    $subdomainComponents[] = Fieldset::make($subdomainLabel)->schema([]);
                }
                // if($subdomain->name){
                    // $subdomainComponents[] = Fieldset::make($subdomain->name)->schema([]);
                // }
            }
            // $noSubdomainQuestions = $domain->questions()->whereNull('subdomain_id')->get();
            dump($subdomainComponents);

			$domainComponents[] = Section::make($domainLabel)->schema([]);
		}
        // dd($subdomainComponents);
        // dd($subdomains);
        return $domainComponents;
	}
}
