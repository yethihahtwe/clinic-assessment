<?php

namespace App\Services\TableComponents;

use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class TableTabs
{
    public static function domainTabs(): array
    {
        $domains = \App\Models\Domain::select('id', 'name')->get();
        $tabs = [];
        foreach ($domains as $domain) {
            $domainId = $domain->id;
            $domainName = $domain->name;

            $tabs[] = Tab::make($domainName)
                ->modifyQueryUsing(fn (Builder $query) => $query->where('domain_id', $domainId));
        }
        return $tabs;
    }
}
