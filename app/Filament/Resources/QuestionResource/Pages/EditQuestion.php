<?php

namespace App\Filament\Resources\QuestionResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\QuestionResource;

class EditQuestion extends EditRecord
{
    protected static string $resource = QuestionResource::class;

    protected function getHeaderActions(): array
    {
        return Auth::user()->email === 'admin@ehssg.org' ? [Actions\DeleteAction::make(),] : [];
    }

    protected function mutateFormDataBeforeSave(array $data): array {
        $data['slug'] = 'd' . $data['domain_id'] . 'q' . $data['number'];
        return $data;
    }

    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle():?string{
        return 'Question successfully updated.';
    }
}
