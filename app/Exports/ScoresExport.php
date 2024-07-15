<?php

namespace App\Exports;

use App\Models\Domain;
use App\Models\Question;
use App\Models\Subdomain;
use App\Models\Assessment;
use App\Models\PossibleResponses;
use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class ScoresExport implements FromArray, WithHeadings, WithStrictNullComparison
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

    public function array(): array
    {
        return $this->getChoices();
    }

    public function headings(): array
    {
        $headings[] = ['Date:', $this->date];
        $headings[] = ['Clinic:', $this->clinic];
        $headings[] = ['Assessment made by:', $this->assessor];
        $headings[] = [''];
        $headings[] = ['Domain', 'Subdomain', 'Question', 'Response', 'Score'];

        return $headings;
    }

    public function getChoices(): array
    {
        $choices = $this->choices;
        $formattedChoices = [];

        $domains = Domain::all();
        foreach ($domains as $domain) {
            $domainId = $domain->id;
            $domainName = $domain->name;

            $subdomains = Subdomain::where('domain_id', $domainId)->get();
            $hasSubdomains = $subdomains->count() > 0;

            if ($hasSubdomains) {
                foreach ($subdomains as $subdomain) {
                    $subdomainId = $subdomain->id;
                    $subdomainName = $subdomain->name;

                    $questions = Question::where(['subdomain_id' => $subdomainId])->get();
                    foreach ($questions as $question) {
                        $questionName = $question->name;
                        $questionId = $question->id;

                        $formattedChoices[] = [
                            'domain' => $domainName,
                            'subdomain' => $subdomainName,
                            'question' => $questionName,
                        ];
                    }
                }
            }
            $formattedChoices[] = [
                'domain' => '',
                'subdomain' => '',
                'question' => Question::find($questionId)->name,
                'value' => $value,
                'score' => PossibleResponses::where([
                    'question_id' => $questionId,
                    'response' => $value
                ])->value('score') ?? 0,
            ];
        }

        // $domains = $this->getDomains();
        // $subdomains = $this->getSubdomains();
        // $questions = $this->getQuestions();

        // foreach ($choices[0] as $questionId => $value) {
        //     $question = collect($questions)->firstWhere('id', $questionId);
        //     if($question)
        //     {
        //         $domain = collect($domains)->firstWhere('id', $question['domain_id']);
        //         $domainName = $domain ? $domain['name'] : '';

        //         $subdomain = collect($subdomains)->firstWhere('id', $question['subdomain_id']);
        //         $subdomainName = $subdomain ? $subdomain['name'] : '';

        //         $formattedChoices[] = [
        //             'domain' => $domainName,
        //             'subdomain' => $subdomainName,
        //             'question' => $question['name'],
        //             'score' => $value,
        //         ];
        //     }
        // }
        return $formattedChoices;
    }

    public function getDomains(): array
    {
        $domains = Domain::all()->map(function ($domain) {
            return [
                'id' => $domain->id,
                'name' => $domain->name,
            ];
        })->toArray();
        return $domains;
    }

    public function getSubdomains(): array
    {
        $subdomains = Subdomain::all()->map(function ($subdomain) {
            return [
                'id' => $subdomain->id,
                'name' => $subdomain->name,
            ];
        })->toArray();
        return $subdomains;
    }

    public function getQuestions(): array
    {
        $questions = Question::all()->map(function ($question) {
            return [
                'name' => $question->name,
                'domain_id' => $question->domain_id,
                'subdomain_id' => $question->subdomain_id,
            ];
        })->toArray();
        return $questions;
    }
}
