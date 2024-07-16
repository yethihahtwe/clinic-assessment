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

        // get total score
        $questionComponents[] = \Filament\Infolists\Components\TextEntry::make('totalScore')
            ->label('Total Score:')
            ->state(function (\App\Models\Assessment $record) use ($questions) {
                $totalScore = 0;
                foreach ($questions as $question) {
                    $questionId = $question->id;
                    $responseTypeId = $question->response_type_id;
                    $state = data_get($record, 'choices.' . $questionId);

                    // single select for total score
                    if ($responseTypeId == 2) {
                        $possibleResponseScore = self::getPossibleResponseScore($questionId, $state);
                    } else if ($responseTypeId == 3) { // multiselect for total score
                        if (is_array($state)) {
                            $possibleResponseScore = 0;
                            foreach ($state as $item) {
                                $possibleResponseScore += 1;
                            }
                        }
                    } else if ($responseTypeId == 5) { // single select and multitextinput for total score
                        $possibleResponseScore = $state;
                    }
                    $totalScore += $possibleResponseScore;
                }
                return $totalScore;
            })
            ->badge()
            ->color('info')
            ->columnSpanFull();

        $i = 1;
        foreach ($questions as $question) {
            $questionId = $question->id;
            $questionLabel = $question->name;
            $responseTypeId = $question->response_type_id;

            // for single select questions
            if ($responseTypeId == 2) {
                $questionComponents[] = \Filament\Infolists\Components\TextEntry::make('choices.' . $questionId)
                    ->label($i . '. ' . $questionLabel)
                    ->default('Not Answered')
                    ->badge()
                    ->hint(function ($state) use ($questionId) {
                        $possibleResponseScore = self::getPossibleResponseScore($questionId, $state) ?? 0;
                        return 'Score: ' . $possibleResponseScore;
                    })
                    ->color(function ($state) use ($questionId) {
                        $possibleResponseScore = self::getPossibleResponseScore($questionId, $state);
                        return self::getColorByScore($possibleResponseScore);
                    });
            } else if ($responseTypeId == 3) { // for multiselect questions
                $questionComponents[] = \Filament\Infolists\Components\TextEntry::make('choices.' . $questionId)
                    ->label($i . '. ' . $questionLabel)
                    ->default('Not Answered')
                    ->listWithLineBreaks()
                    ->bulleted()
                    ->hint(function ($state) {
                        $score = 0;
                        if (is_array($state)) {
                            foreach ($state as $item) {
                                $score += 1;
                            }
                        }
                        return 'Score: ' . $score;
                    })
                    ->color(function ($state): string {
                        if ($state === 'Not Answered') {
                            return 'gray';
                        }
                        return 'success';
                    });
            } else if ($responseTypeId == 5) { // for single select and multiple text input questions
                $questionComponents[] = \Filament\Infolists\Components\TextEntry::make('choices.' . $questionId)
                    ->label($i . '. ' . $questionLabel)
                    ->default('Not Answered')
                    ->badge()
                    ->hint(function ($state) {
                        $score = match ($state){
                          '1' => 1,
                          '0' => 0,
                          'Not Answered' => 0,
                        };
                        return 'Score: ' . $score;
                    })
                    ->formatStateUsing(fn (\App\Models\Assessment $record, $state): string => match ($state) {
                        '1' => 'Yes, Male: ' . $record->choices[$questionId . '_Male'] . ', Female: ' . $record->choices[$questionId . '_Female'] . ', Other: ' . $record->choices[$questionId . '_Other'],
                        '0' => 'No',
                        default => 'Not Answered',
                    })
                    ->color(
                        fn ($state): string => match ($state) {
                            '1' => 'success',
                            '0' => 'warning',
                            default => 'gray',
                        }
                    );
            }
            $i++;
        }



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
