<?php

namespace App\Filament\Resources\DomainResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\DomainResource;

class EditDomain extends EditRecord
{
    protected static string $resource = DomainResource::class;

    protected function getHeaderActions(): array
    {
        return Auth::user()->email === 'admin@ehssg.org' ? [Actions\DeleteAction::make(),] : [];
    }

    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle():?string{
        return 'Domain successfully updated.';
    }
}
