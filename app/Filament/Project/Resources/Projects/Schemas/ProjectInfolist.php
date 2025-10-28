<?php

declare(strict_types=1);

namespace App\Filament\Project\Resources\Projects\Schemas;

use App\Filament\Settings\Clusters\Priority\Resources\TicketPrioritySchemes\Pages\EditTicketPriorityScheme;
use App\Filament\Settings\Clusters\Status\Resources\TicketStatusSchemes\Pages\EditTicketStatusScheme;
use App\Filament\Settings\Clusters\TicketType\Resources\TicketTypeSchemes\Pages\EditTicketTypeScheme;
use App\Models\Project;
use App\Models\TicketPriorityScheme;
use App\Models\TicketStatusScheme;
use App\Models\TicketTypeScheme;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProjectInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Basic Information
                Section::make('Project Details')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        TextEntry::make('ticket_prefix')
                            ->badge()
                            ->color('primary')
                            ->icon('heroicon-o-hashtag'),

                        TextEntry::make('description')
                            ->placeholder('No description provided')
                            ->markdown()
                            ->columnSpanFull(),
                    ])
                    ->columnSpan('full'),

                // Schemes Configuration
                Section::make('Configuration')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('ticketTypeScheme')
                                    ->url(fn (TicketTypeScheme $state) => EditTicketTypeScheme::getUrl(['record' => $state], panel: 'settings'))
                                    ->formatStateUsing(fn (TicketTypeScheme $state) => $state->name)
                                    ->label('Ticket Type Scheme')
                                    ->icon('heroicon-o-tag')
                                    ->color('info')
                                    ->placeholder('Not configured'),

                                TextEntry::make('ticketPriorityScheme')
                                    ->url(fn (TicketPriorityScheme $state) => EditTicketPriorityScheme::getUrl(['record' => $state], panel: 'settings'))
                                    ->formatStateUsing(fn (TicketPriorityScheme $state) => $state->name)
                                    ->label('Ticket Priority Scheme')
                                    ->icon('heroicon-o-flag')
                                    ->color('warning')
                                    ->placeholder('Not configured'),

                                TextEntry::make('ticketStatusScheme')
                                    ->url(fn (TicketStatusScheme $state) => EditTicketStatusScheme::getUrl(['record' => $state], panel: 'settings'))
                                    ->formatStateUsing(fn (TicketStatusScheme $state) => $state->name)
                                    ->label('Ticket Status Scheme')
                                    ->icon('heroicon-o-signal')
                                    ->color('success')
                                    ->placeholder('Not configured'),
                            ]),
                    ])
                    ->collapsible()
                    ->columnSpan('full'),

                // Timestamps
                Section::make('Metadata')
                    ->icon('heroicon-o-clock')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Created')
                                    ->dateTime()
                                    ->icon('heroicon-o-plus-circle'),

                                TextEntry::make('updated_at')
                                    ->label('Last Updated')
                                    ->dateTime()
                                    ->since()
                                    ->icon('heroicon-o-pencil'),

                                TextEntry::make('deleted_at')
                                    ->label('Deleted')
                                    ->dateTime()
                                    ->icon('heroicon-o-trash')
                                    ->color('danger')
                                    ->visible(fn (Project $record): bool => $record->trashed()),
                            ]),
                    ])
                    ->collapsible()
                    ->collapsed()
                    ->columnSpan('full'),
            ]);
    }
}
