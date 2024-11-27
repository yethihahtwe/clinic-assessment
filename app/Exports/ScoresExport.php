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
use App\Services\AssessmentInfolistService;

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
        $totalScore = 0;
        $totalMaxScore = 0;

        $domains = Domain::with(['subdomains.questions', 'questions'])->get();

        foreach ($domains as $domain) {
            $domainScore = 0;
            $domainMaxScore = 0;
            $domainQuestions = collect();

            if ($domain->subdomains->isNotEmpty()) {
                foreach ($domain->subdomains as $subdomain) {
                    foreach ($subdomain->questions as $question) {
                        $domainQuestions->push($question);
                        $result = $this->processQuestion($domain->name, $subdomain->name, $question);
                        $data[] = $result;
                        $domainScore += $result['score'];
                    }
                }
            } else {
                foreach ($domain->questions as $question) {
                    $domainQuestions->push($question);
                    $result = $this->processQuestion($domain->name, '', $question);
                    $data[] = $result;
                    $domainScore += $result['score'];
                }
            }

            $domainMaxScore = AssessmentInfolistService::calculateMaximumScore($domainQuestions);
            $domainScorePercentage = AssessmentInfolistService::calculateScorePercentage($domainScore, $domainMaxScore);

            $data[] = [
                'domain' => $domain->name,
                'subdomain' => 'Total',
                'question' => '',
                'response' => '',
                'score' => "$domainScore/$domainMaxScore ($domainScorePercentage)"
            ];

            $totalScore += $domainScore;
            $totalMaxScore += $domainMaxScore;
        }

        $totalScorePercentage = AssessmentInfolistService::calculateScorePercentage($totalScore, $totalMaxScore);
        $data[] = [
            'domain' => 'Overall Total',
            'subdomain' => '',
            'question' => '',
            'response' => '',
            'score' => "$totalScore/$totalMaxScore ($totalScorePercentage)"
        ];

        return $data;
    }

    private function processQuestion($domainName, $subdomainName, $question): array
    {
        $value = $this->choices[0][$question->id] ?? 'Not Answered';
        $score = 0;

        switch ($question->response_type_id) {
            case 2: // RESPONSE_TYPE_SINGLE_SELECT
                $score = AssessmentInfolistService::getPossibleResponseScore($question->id, $value) ?? 0;
                break;
            case 3: // RESPONSE_TYPE_MULTI_SELECT
                if (is_array($value)) {
                    $score = count($value);
                    $value = implode(', ', $value);
                }
                break;
            case 5: // RESPONSE_TYPE_SINGLE_SELECT_WITH_TEXT
                $boolValue = $this->choices[0][$question->id] ?? 0;
                $value = AssessmentInfolistService::formatSingleSelectWithText(new Assessment(['choices' => $this->choices[0]]), $boolValue, $question->id);
                $score = $boolValue ? 1 : 0;
                break;
        }

        return [
            'domain' => $domainName,
            'subdomain' => $subdomainName,
            'question' => $question->name,
            'response' => $value,
            'score' => $score,
        ];
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
}
