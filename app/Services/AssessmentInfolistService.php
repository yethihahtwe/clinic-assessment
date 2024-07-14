<?php

namespace App\Services;

use App\Models\Domain;
use Filament\Infolists\Components\Tabs\Tab;
use Filament\Infolists\Components\ViewEntry;

class AssessmentInfoListService
{

    public static function schema(): array
    {
        return self::getDomains();
    }

    protected static function getDomains(): array
    {
        // fetch domains
        $domains = Domain::all();
        $domainComponents = [];
        foreach ($domains as $domain) {
            $domainId = $domain->id;
            $domainLabel = $domain->name;

            // fetch subdomains
            $subdomains = \App\Models\Subdomain::where('domain_id', $domainId)->get();
            $hasSubdomains = $subdomains->isNotEmpty();

            if ($hasSubdomains) {
                $domainComponents[] = Tab::make($domainLabel)->schema(self::getSubdomains($subdomains))->columns(2);
            } else {
                $domainComponents[] = Tab::make($domainLabel)->schema(
                    // ViewEntry::make('responses')->view('filament.infolists.entries.responses', ['domainId' => $domain->id]),
                    self::getQuestions('domain', $domainId)
                )->columns(2);
            }
        }
        return $domainComponents;
    }

    protected static function getSubdomains($subdomains): array
    {
        $subdomainComponents = [];
        foreach ($subdomains as $subdomain) {
            $subdomainId = $subdomain->id;
            $subdomainLabel = $subdomain->name;

            $subdomainComponents[] = \Filament\Infolists\Components\Section::make($subdomainLabel)
                ->label($subdomainLabel)
                ->schema(self::getQuestions('subdomain', $subdomainId))
                ->columns(2);
        }
        return $subdomainComponents;
    }

    protected static function getQuestions($idType, $id)
    {
        if ($idType === 'domain') {
            $questions = \App\Models\Question::where('domain_id', $id)->get();
        } else if ($idType === 'subdomain') {
            $questions = \App\Models\Question::where('subdomain_id', $id)->get();
        }
        $questionComponents = [];
        $i = 1;
        $totalScore = 0;
        foreach ($questions as $question) {
            $questionId = $question->id;
            $questionLabel = $question->name;
            $questionComponents[] = \Filament\Infolists\Components\TextEntry::make('choices.' . $questionId)
                ->label($i . '. ' . $questionLabel)
                ->default('Not Answered')
                ->badge()
                ->hint(function ($state) use ($questionId, &$totalScore) {
                    $possibleResponseScore = self::getPossibleResponseScore($questionId, $state) ?? 0;
                    $totalScore += $possibleResponseScore;
                    return 'Score: ' . $possibleResponseScore . '/total: ' . $totalScore;
                })
                ->color(function ($state) use ($questionId) {
                    $possibleResponseScore = self::getPossibleResponseScore($questionId, $state);
                    return self::getColorByScore($possibleResponseScore);
                });
            $i++;
        }

        $questionComponents[] = \Filament\Infolists\Components\TextEntry::make('totalScore')
            ->label('Total Score')
            ->state($totalScore)
            ->badge()
            ->color('primary');

        return $questionComponents;
    }

    protected static function getPossibleResponseScore($questionId, $state)
    {
        $possibleResponse = \App\Models\PossibleResponses::where([
            'question_id' => $questionId,
            'response' => $state,
        ])->first();
        $possibleResponseScore = $possibleResponse ? $possibleResponse->score : null;
        return $possibleResponseScore;
    }

    protected static function getColorByScore($score)
    {
        return match ($score) {
            1 => 'success',
            0 => 'warning',
            null => 'gray',
        };
    }
}
