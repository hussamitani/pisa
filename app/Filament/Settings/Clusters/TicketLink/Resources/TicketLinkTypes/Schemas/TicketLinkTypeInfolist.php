<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\TicketLink\Resources\TicketLinkTypes\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TicketLinkTypeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('inward_description'),
                TextEntry::make('outward_description'),
                IconEntry::make('is_system')
                    ->boolean(),
                IconEntry::make('is_hierarchical')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
