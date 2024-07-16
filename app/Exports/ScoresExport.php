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
    protected $organization;

    public function __construct(array $choices, string $clinic, string $date, string $assessor, string $organization)
    {
        $this->choices = $choices;
        $this->clinic = $clinic;
        $this->date = $date;
        $this->assessor = $assessor;
        $this->organization = $organization;
    }

    public function array(): array
    {
        $data = [];

        $domains = Domain::with('subdomains.questions', 'questions')->get();

        foreach ($domains as $domain) {
            if ($domain->subdomains->isNotEmpty()) {
                foreach ($domain->subdomains as $subdomain) {
                    foreach ($subdomain->questions as $question) {
                        $data[] = $this->processQuestion($domain->name, $subdomain->name, $question);
                    }
                }
            } else {
                foreach ($domain->questions as $question) {
                    $data[] = $this->processQuestion($domain->name, '', $question);
                }
            }
        }
        return $data;
    }

    private function processQuestion($domainName, $subdomainName, $question): array
    {
        $value = $this->choices[0][$question->id] ?? 'Not Answered';
        $score = 0;

        switch ($question->response_type_id) {
            case 2:
                $score = $this->getScore($question->id, $value) ?? 0;
                break;
            case 3:
                if (is_array($value)) {
                    $score = count($value);
                    $value = implode(', ', $value);
                }
                break;
            case 5:
                $boolValue = $this->choices[0][$question->id] ?? 0;
                $value = match($boolValue){
                    '1' => 'Yes, Male: '. $this->choices[0][$question->id . '_Male'] .', Female: ' . $this->choices[0][$question->id . '_Female'] . ', Other: ' . $this->choices[0][$question->id . '_Other'],
                    '0' => 'No',
                    default => 'Not Answered'
                };
                $score = $boolValue;
                break;
        }

        return compact('domainName', 'subdomainName') + ['question' => $question->name] +  compact('value', 'score');
    }

    public function headings(): array
    {
        $headings[] = ['Date:', $this->date];
        $headings[] = ['Clinic:', $this->clinic];
        $headings[] = ['Assessment made by:', $this->assessor];
        if (auth()->user()->is_admin) {
            $headings[] = ['Organization:', $this->organization];
        }
        $headings[] = [''];
        $headings[] = ['Domain', 'Subdomain', 'Question', 'Response', 'Score'];

        return $headings;
    }

    public function getBody(): array
    {
        $body = [];
        $choices = $this->choices;

        $domains = self::getDomains();

        foreach ($domains as $domain) {
            $domainId = $domain->id;
            $domainName = $domain->name;

            $subdomains = self::getSubdomains($domainId);
            $hasSubdomains = $subdomains->count() > 0;

            if ($hasSubdomains) {
                foreach ($subdomains as $subdomain) {
                    $subdomainId = $subdomain->id;
                    $subdomainName = $subdomain->name;
                    $questions = self::getQuestions('subdomain', $subdomainId);
                }
            } else {
                $questions = self::getQuestions('domain', $domainId);
            }

            foreach ($questions as $question) {
                $questionId = $question->id;
                $questionName = $question->name;

                $responseType = $question->response_type_id;

                if ($responseType == 2) {
                    $response = $choices[0][$questionId] ?? 'Not Answered';
                    $score = self::getScore($questionId, $response) ?? 0;
                } else if ($responseType == 3) {
                    $response =  $choices[0][$questionId];
                    $score = 0;
                    if (is_array($response)) {
                        foreach ($response as $item) {
                            $score += 1;
                        }
                    }
                }

                $body[] = self::constructArray(
                    $domainName,
                    $subdomainName ?? '',
                    $questionName,
                    $response,
                    $score,
                );
            }
        }
        dd($body);
        return $body;
    }

    protected static function getDomains()
    {
        $domains = Domain::all();
        return $domains;
    }

    protected static function getSubdomains($domainId)
    {
        $subdomains = Subdomain::where('domain_id', $domainId)->get();
        return $subdomains;
    }

    protected static function getQuestions($idType, $id)
    {
        if ($idType === 'domain') {
            $questions = Question::where(['domain_id' => $id])->get();
        } elseif ($idType === 'subdomain') {
            $questions = Question::where(['subdomain_id' => $id])->get();
        }
        return $questions;
    }

    protected static function getScore($questionId, $response)
    {
        $score = PossibleResponses::where([
            'question_id' => $questionId,
            'response' => $response
        ])->value('score') ?? 0;
        return $score;
    }

    protected static function constructArray(
        $domainName,
        $subdomainName,
        $questionName,
        $response,
        $score
    ) {
        $constructedArray = [
            'domain' => $domainName,
            'subdomain' => $subdomainName,
            'question' => $questionName,
            'response' => $response,
            'score' => $score,
        ];
        return $constructedArray;
    }
}
