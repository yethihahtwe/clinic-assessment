<?php

namespace App\Filament\User\Resources\ClinicResource\Pages;

use App\Filament\User\Resources\ClinicResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClinic extends EditRecord
{
    protected static string $resource = ClinicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle():?string{
        return 'Clinic successfully updated.';
    }
}
