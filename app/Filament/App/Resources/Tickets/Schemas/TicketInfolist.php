<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Tickets\Schemas;

use App\Models\Ticket;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TicketInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('content')
                    ->columnSpanFull(),
                TextEntry::make('code'),
                TextEntry::make('owner.name')
                    ->label('Owner'),
                TextEntry::make('responsible.name')
                    ->label('Responsible')
                    ->placeholder('-'),
                TextEntry::make('project.name')
                    ->label('Project'),
                TextEntry::make('type.name')
                    ->label('Type'),
                TextEntry::make('status.name')
                    ->label('Status'),
                TextEntry::make('priority.name')
                    ->label('Priority'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Ticket $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
