<?php

namespace App\Filament\Resources\PossibleResponseResource\Pages;

use App\Filament\Resources\PossibleResponseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPossibleResponse extends EditRecord
{
    protected static string $resource = PossibleResponseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
