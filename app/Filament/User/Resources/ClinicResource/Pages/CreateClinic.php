<?php

namespace App\Filament\User\Resources\ClinicResource\Pages;

use App\Filament\User\Resources\ClinicResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateClinic extends CreateRecord
{
    protected static string $resource = ClinicResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['organization_id'] = auth()->user()->organization_id;
        return $data;
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Clinic successfully created.';
    }
}
