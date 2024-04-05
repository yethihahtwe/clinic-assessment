<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;

class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form->schema([
            $this->getNameFormComponent()->columnSpanFull(),
            $this->getEmailFormComponent()->columnSpanFull(),
            $this->getPasswordFormComponent()->columnSpanFull(),
            $this->getPasswordConfirmationFormComponent()->columnSpanFull(),
            TextInput::make('position')
                ->placeholder('Please enter position')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),
            Select::make('country_code')
                ->placeholder('Select')
                ->options(['+66' => 'Thailand (+66)', '+95' => 'Myanmar (+95)'])
                ->live()
                ->native(false)
                ->columnSpan(2),
            TextInput::make('phone')
                ->prefix(function (Get $get) {
                    return match ($get('country_code')) {
                        '+66' => '+66',
                        '+95' => '+95',
                        default => null,
                    };
                })
                ->suffixIcon('heroicon-o-device-phone-mobile')
                ->placeholder('Please enter phone number')
                ->maxLength(255)
                ->tel()
                ->columnSpan(3),
            FileUpload::make('avatar')->avatar()->imageEditor()->directory('avatars')->columnSpanFull(),
        ])->columns(5);
    }
}
