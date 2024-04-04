<?php

namespace App\Filament\User\Resources\AssessorResource\Pages;

use App\Filament\User\Resources\AssessorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssessor extends EditRecord
{
    protected static string $resource = AssessorResource::class;

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
        return 'Assessor successfully updated.';
    }
}
