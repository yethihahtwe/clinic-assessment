<?php

namespace App\Filament\User\Resources\AssessmentResource\Pages;

use App\Filament\User\Resources\AssessmentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAssessment extends CreateRecord
{
    protected static string $resource = AssessmentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->user()->id;
        return $data;
    }

    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Assessment successfully created.';
    }
}
