<?php

namespace App\Filament\User\Resources\AssessorResource\Pages;

use App\Filament\User\Resources\AssessorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAssessor extends CreateRecord
{
    protected static string $resource = AssessorResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->user()->id;
        $data['organization_id'] = auth()->user()->organization_id;
        return $data;
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Assessor successfully created.';
    }
}
