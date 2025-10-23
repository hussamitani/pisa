<?php

namespace App\Filament\Project\Resources\Projects\Schemas;

use App\Models\Project;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProjectInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('ticket_prefix'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Project $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('ticketTypeScheme.name')
                    ->label('Ticket type scheme'),
                TextEntry::make('ticketPriorityScheme.name')
                    ->label('Ticket priority scheme'),
                TextEntry::make('ticketStatusScheme.name')
                    ->label('Ticket status scheme'),
            ]);
    }
}
