<?php

namespace App\Filament\Resources\ResponseTypeResource\Pages;

use App\Filament\Resources\ResponseTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResponseType extends EditRecord
{
    protected static string $resource = ResponseTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
