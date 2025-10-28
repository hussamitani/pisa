<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Sprints\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SprintInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')->label(__('Sprint name'))->columnSpanFull(),
                TextEntry::make('begins_at')->date('d.m.Y'),
                TextEntry::make('ends_at')->date('d.m.Y'),
                TextEntry::make('description')->columnSpanFull(),
            ]);
    }
}
