<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\TicketType\Resources\TicketTypes\Schemas;

use App\Models\TicketType;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TicketTypeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('icon'),
                TextEntry::make('color'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (TicketType $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
