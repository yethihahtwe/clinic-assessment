<?php

namespace App\Filament\Resources\QuestionResource\Pages;

use App\Filament\Resources\QuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateQuestion extends CreateRecord
{
    protected static string $resource = QuestionResource::class;

    // protected function mutateFormDataBeforeCreate(array $data): array {
    //     $data['slug'] = 'd' . $data['domain_id'] . 'q' . $data['number'];
    //     return $data;
    // }

    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle():?string{
        return 'Question successfully created.';
    }
}
