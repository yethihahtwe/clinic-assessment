<?php

namespace App\Filament\User\Resources\AssessmentResource\Pages;

use App\Filament\User\Resources\AssessmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssessment extends EditRecord
{
    protected static string $resource = AssessmentResource::class;

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
        return 'Assessment successfully updated.';
    }
}
