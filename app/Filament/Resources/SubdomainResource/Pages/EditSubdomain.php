<?php

namespace App\Filament\Resources\SubdomainResource\Pages;

use App\Filament\Resources\SubdomainResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubdomain extends EditRecord
{
    protected static string $resource = SubdomainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
