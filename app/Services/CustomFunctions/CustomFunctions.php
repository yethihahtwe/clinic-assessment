<?php

namespace App\Services\CustomFunctions;

use Filament\Forms\Components\Radio;
use App\Services\Options\CustomArrays;
use Filament\Forms\Components\TextInput;

class CustomFunctions
{
    public static function getQuestionComponents($question, $i): array
    {
        $questionLabel = $question->name;
        $questionSlug = $question->slug;
        $isRequiredMoreTextInput = in_array($questionSlug, CustomArrays::$isRequiredMoreTextInputFields);

        $questionComponents[] = Radio::make('choices.' . $questionSlug)
            ->label($i . '. ' . $questionLabel)
            ->boolean()
            ->inline()
            ->inlineLabel(false)
            ->live($isRequiredMoreTextInput);

        if ($isRequiredMoreTextInput) {
            $questionComponents[] = [
                TextInput::make('choices.' . $questionSlug . '.m')
                    ->label('Male')
                    ->numeric()
                    ->step(1),
                TextInput::make('choices.' . $questionSlug . '.f')
                    ->label('Female')
                    ->numeric()
                    ->step(1),
                TextInput::make('choices.' . $questionSlug . '.o')
                    ->label('Other')
                    ->numeric()
                    ->step(1),
            ];
        }
        return $questionComponents;
    }
}
