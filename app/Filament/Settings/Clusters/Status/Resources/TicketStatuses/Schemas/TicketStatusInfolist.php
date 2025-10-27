<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\Status\Resources\TicketStatuses\Schemas;

use App\Models\TicketStatus;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TicketStatusInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('color'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (TicketStatus $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
