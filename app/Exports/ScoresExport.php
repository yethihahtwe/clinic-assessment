<?php

namespace App\Exports;
use App\Models\Domain;
use App\Models\Question;
use App\Models\Subdomain;
use App\Models\Assessment;
use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ScoresExport implements FromArray, WithHeadings
{
	protected $choices;
    protected $clinic;
    protected $date;
    protected $assessor;

	public function __construct(array $choices, string $clinic, string $date, string $assessor)
	{
        $this->choices = $choices;
        $this->clinic = $clinic;
        $this->date = $date;
        $this->assessor = $assessor;
	}

    public function array():array
    {
        return $this->getChoices();
    }

    public function headings():array
    {
        $headings[] = ['Date:', $this->date];
        $headings[] = ['Clinic:', $this->clinic];
        $headings[] = ['Assessment made by:', $this->assessor];
        $headings[] = [''];
        $headings[] = ['Domain', 'Subdomain', 'Question', 'Score'];

        return $headings;
    }

    public function getChoices(): array
    {
        $choices = $this->choices;
        $formattedChoices = [];

        $domains = $this->getDomains();
        $subdomains = $this->getSubdomains();
        $questions = $this->getQuestions();

        foreach ($choices[0] as $slug => $value) {
            $question = collect($questions)->firstWhere('slug', $slug);
            if($question)
            {
                $domain = collect($domains)->firstWhere('id', $question['domain_id']);
                $domainName = $domain ? $domain['name'] : '';

                $subdomain = collect($subdomains)->firstWhere('id', $question['subdomain_id']);
                $subdomainName = $subdomain ? $subdomain['name'] : '';

                $formattedChoices[] = [
                    'domain' => $domainName,
                    'subdomain' => $subdomainName,
                    'question' => $question['name'],
                    'score' => $value,
                ];
            }
        }
        return $formattedChoices;
    }

    public function getDomains():array
    {
        $domains = Domain::all()->map(function($domain)
        {
            return [
                'id' => $domain->id,
                'name' => $domain->name,
            ];
        })->toArray();
        return $domains;
    }

    public function getSubdomains():array
    {
        $subdomains = Subdomain::all()->map(function($subdomain)
        {
            return [
                'id' => $subdomain->id,
                'name' => $subdomain->name,
            ];
        })->toArray();
        return $subdomains;
    }

    public function getQuestions():array
    {
        $questions = Question::all()->map(function($question)
        {
            return [
                'name' => $question->name,
                'domain_id' => $question->domain_id,
                'subdomain_id' => $question->subdomain_id,
                'slug' => $question->slug,
            ];
        })->toArray();
        return $questions;
    }
}
