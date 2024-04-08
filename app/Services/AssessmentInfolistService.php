<?php
namespace App\Services;

use App\Models\Domain;
use Filament\Infolists\Components\Tabs\Tab;
use Filament\Infolists\Components\ViewEntry;

class AssessmentInfoListService {

    public static function schema(): array {
        $domains = Domain::all();
        $components = [];

        foreach($domains as $domain){
            $domainLabel = $domain->name;
            $components[] = Tab::make($domainLabel)->schema([
                ViewEntry::make('responses')->view('filament.infolists.entries.responses', ['domainId' => $domain->id]),
            ]);
        }
        return $components;
    }
}
