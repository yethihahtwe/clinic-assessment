<?php

namespace App\Services;

use App\Models\Domain;
use App\Models\Question;
use App\Models\Subdomain;
use App\Models\Assessment;
use App\Models\PossibleResponses;
use Filament\Infolists\Components\Tabs\Tab;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AssessmentInfolistService
{
    // RESPONSE TYPE CONSTANTS
    public const RESPONSE_TYPE_SINGLE_SELECT = 2;
    public const RESPONSE_TYPE_MULTI_SELECT = 3;
    public const RESPONSE_TYPE_SINGLE_SELECT_WITH_TEXT = 5;
    // MAIN SCHEMA
    public static function schema(): array
    {
        return self::getDomains();
    }

    // GET DOMAINS WITH EAGER LOADING SUBDOMAINS, QUESTIONS AND POSSIBLE RESPONSES
    protected static function getDomains(): array
    {
        $domains = Domain::with(['subdomains', 'questions', 'questions.possibleResponses'])->get()->toArray();
        return self::buildDomainComponents($domains);
    }

    // BUILD ACTUAL COMPONENTS
    protected static function buildDomainComponents(array $domains): array
    {
        return collect($domains)->map(function ($domain) {
            $hasSubdomains = !empty($domain['subdomains']);

            // For domains without subdomains, use the questions from the eager loaded relation
            if (!$hasSubdomains) {
                return Tab::make($domain['name'])
                    ->schema(self::buildQuestionComponents(collect($domain['questions'])))  // Use directly from relation
                    ->columns(2);
            }

            // For domains with subdomains
            return Tab::make($domain['name'])
                ->schema(self::getSubdomains(
                    collect($domain['subdomains']),
                    collect($domain['questions'])
                ))
                ->columns(2);
        })->toArray();
    }

    protected static function getSubdomains(Collection $subdomains, Collection $questions): array
    {
        $scorePercentage = function (Assessment $record) use ($questions) {
            return self::calculateScorePercentage(
                self::calculateTotalScore($record, $questions),
                self::calculateMaximumScore($questions)
            );
        };

        $subdomainComponents = [
            self::buildDomainTotalScoreTextEntry($questions),
            self::buildDomainTotalScorePercentageTextEntry($scorePercentage)
        ];

        foreach ($subdomains as $subdomain) {
            $subdomainComponents[] = Section::make($subdomain['name'])
                ->label($subdomain['name'])
                ->schema(self::getQuestions('subdomain', $subdomain['id']))
                ->columns(2);
        }

        return $subdomainComponents;
    }

    protected static function getQuestions(string $idType, int $id): array
    {
        $questions = Question::when(
            $idType === 'domain',
            fn($query) => $query->where('domain_id', $id),
            fn($query) => $query->where('subdomain_id', $id)
        )
            ->with('possibleResponses')  // possible responses from eager loading
            ->get()
            ->toArray();

        // To ensure questions is not empty before building components
        if (empty($questions)) {
            return [];
        }

        return self::buildQuestionComponents(collect($questions));
    }

    protected static function buildQuestionComponents(Collection $questions): array
    {
        $totalMaxScore = self::calculateMaximumScore($questions);

        $components = [
            self::buildTotalScoreEntry($questions, $totalMaxScore),
            self::buildScorePercentageEntry($questions)
        ];

        return array_merge(
            $components,
            $questions->map(
                fn($question, $index) =>
                self::buildQuestionComponent($question, $index + 1)
            )->filter()->toArray()
        );
    }

    protected static function buildQuestionComponent(array $question, int $index): ?TextEntry
    {
        $methodMap = [
            self::RESPONSE_TYPE_SINGLE_SELECT => 'buildSingleSelectComponent',
            self::RESPONSE_TYPE_MULTI_SELECT => 'buildMultiSelectComponent',
            self::RESPONSE_TYPE_SINGLE_SELECT_WITH_TEXT => 'buildSingleSelectWithTextComponent',
        ];

        $method = $methodMap[$question['response_type_id']] ?? null;
        return $method ? self::$method($question, $index) : null;
    }

    protected static function buildSingleSelectComponent(array $question, int $index): TextEntry
    {
        return TextEntry::make('choices.' . $question['id'])
            ->label($index . '. ' . $question['name'])
            ->default('Not Answered')
            ->badge()
            ->hint(fn($state) => 'Score: ' . (self::getPossibleResponseScore($question['id'], $state) ?? 0))
            ->color(fn($state) => self::getColorByScore(self::getPossibleResponseScore($question['id'], $state)));
    }

    protected static function buildMultiSelectComponent(array $question, int $index): TextEntry
    {
        return TextEntry::make('choices.' . $question['id'])
            ->label($index . '. ' . $question['name'])
            ->default('Not Answered')
            ->listWithLineBreaks()
            ->bulleted()
            ->hint(fn($state) => 'Score: ' . (is_array($state) ? count($state) : 0))
            ->color(fn($state) => $state === 'Not Answered' ? 'gray' : 'success');
    }

    protected static function buildSingleSelectWithTextComponent(array $question, int $index): TextEntry
    {
        return TextEntry::make('choices.' . $question['id'])
            ->label($index . '. ' . $question['name'])
            ->default('Not Answered')
            ->badge()
            ->hint(fn($state) => 'Score: ' . ($state === '1' ? 1 : 0))
            ->formatStateUsing(fn(Assessment $record, $state): string => self::formatSingleSelectWithText($record, $state, $question['id']))
            ->color(fn($state): string => match ($state) {
                '1' => 'success',
                '0' => 'warning',
                default => 'gray',
            });
    }

    public static function formatSingleSelectWithText(Assessment $record, $state, $questionId): string
    {
        return match ($state) {
            '1' => sprintf(
                'Yes, Male: %s, Female: %s, Other: %s',
                $record->choices[$questionId . '_Male'] ?? '',
                $record->choices[$questionId . '_Female'] ?? '',
                $record->choices[$questionId . '_Other'] ?? ''
            ),
            '0' => 'No',
            default => 'Not Answered',
        };
    }

    public static function calculateMaximumScore(Collection $questions): int
    {
        return $questions->sum(function ($question) {
            return match ($question['response_type_id']) {
                self::RESPONSE_TYPE_SINGLE_SELECT,
                self::RESPONSE_TYPE_SINGLE_SELECT_WITH_TEXT => 1,
                self::RESPONSE_TYPE_MULTI_SELECT =>
                isset($question['possible_responses']) ? count($question['possible_responses']) : 0,
                default => 0
            };
        });
    }

    public static function calculateTotalScore(Assessment $record, Collection $questions): int
    {
        return $questions->sum(function ($question) use ($record) {
            $state = data_get($record, 'choices.' . $question['id']);

            return match ($question['response_type_id']) {
                self::RESPONSE_TYPE_SINGLE_SELECT => self::getPossibleResponseScore($question['id'], $state) ?? 0,
                self::RESPONSE_TYPE_MULTI_SELECT => is_array($state) ? count($state) : 0,
                self::RESPONSE_TYPE_SINGLE_SELECT_WITH_TEXT => $state === '1' ? 1 : 0,
                default => 0
            };
        });
    }

    public static function calculateScorePercentage(int $totalScore, int $maxScore): string
    {
        $percentage = ($maxScore > 0) ? ($totalScore / $maxScore) * 100 : 0;
        return number_format($percentage, 1) . '%';
    }

    public static function getPossibleResponseScore(int $questionId, $state): ?int
    {
        try {
            $possibleResponse = PossibleResponses::where([
                'question_id' => $questionId,
                'response' => $state,
            ])->first();

            return $possibleResponse ? $possibleResponse->score : null;
        } catch (\Exception $e) {
            Log::warning("Failed to get score for question {$questionId} with state {$state}", [
                'exception' => $e->getMessage()
            ]);
            return null;
        }
    }

    protected static function getColorByScore(?int $score): string
    {
        return match ($score) {
            1 => 'success',
            0 => 'warning',
            default => 'gray',
        };
    }

    protected static function buildTotalScoreEntry(Collection $questions, int $totalMaxScore): TextEntry
    {
        return TextEntry::make('totalScore')
            ->label('Total Score:')
            ->state(
                fn(Assessment $record) =>
                self::calculateTotalScore($record, $questions) . '/' . $totalMaxScore
            )
            ->badge()
            ->color('info');
    }

    protected static function buildScorePercentageEntry(Collection $questions): TextEntry
    {
        return TextEntry::make('scorePercentage')
            ->label('Score Percentage:')
            ->state(fn(Assessment $record) => self::calculateScorePercentage(
                self::calculateTotalScore($record, $questions),
                self::calculateMaximumScore($questions)
            ))
            ->badge()
            ->color('info');
    }

    protected static function buildDomainTotalScoreTextEntry(Collection $questions): TextEntry
    {
        return TextEntry::make('domainTotalScore')
            ->label('Domain Total Score:')
            ->inlineLabel()
            ->state(fn(Assessment $record) => sprintf(
                '%d/%d',
                self::calculateTotalScore($record, $questions),
                self::calculateMaximumScore($questions)
            ))
            ->badge()
            ->color('info')
            ->columnSpan(1);
    }

    protected static function buildDomainTotalScorePercentageTextEntry(callable $scorePercentage): TextEntry
    {
        return TextEntry::make('domainTotalScorePercentage')
            ->label('Domain Total Score Percentage:')
            ->inlineLabel()
            ->state($scorePercentage)
            ->badge()
            ->color('info')
            ->columnSpan(1);
    }
}
