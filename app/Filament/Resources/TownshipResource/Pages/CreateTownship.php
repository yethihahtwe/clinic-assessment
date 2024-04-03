<?php

namespace App\Filament\Resources\TownshipResource\Pages;

use App\Filament\Resources\TownshipResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTownship extends CreateRecord
{
    protected static string $resource = TownshipResource::class;

    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle():?string{
        return 'Township successfully created.';
    }
}
