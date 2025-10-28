<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Tickets\Schemas;

use App\Filament\App\Resources\Tickets\Pages\ViewTicket;
use App\Models\Ticket;
use App\Models\TicketLink;
use App\Models\User;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\Commentions\Filament\Infolists\Components\CommentsEntry;

class TicketInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Grid::make([
                    'default' => 1,
                    'md' => 4,
                ])
                    ->schema([
                        // Main content area (left side - 2 columns)
                        Grid::make(1)
                            ->schema([
                                Section::make('Description')
                                    ->schema([
                                        TextEntry::make('description')
                                            ->html()
                                            ->prose()
                                            ->hiddenLabel(),
                                    ])
                                    ->collapsible()
                                    ->collapsed(false),

                                Section::make('Linked Tickets')
                                    ->icon('heroicon-o-link')
                                    ->description('Related tickets and dependencies')
                                    ->schema([
                                        Group::make()
                                            ->schema(
                                                collect()
                                                    ->push(
                                                        // Outward links
                                                        RepeatableEntry::make('outwardLinks')
                                                            ->label('')
                                                            ->schema([
                                                                TextEntry::make('linkType.outward_description')
                                                                    ->label('Relationship')
                                                                    ->badge()
                                                                    ->color('info')
                                                                    ->icon('heroicon-o-arrow-right'),

                                                                TextEntry::make('targetTicket.code')
                                                                    ->label('Ticket')
                                                                    ->badge()
                                                                    ->color('gray')
                                                                    ->url(fn (TicketLink $record) => ViewTicket::getUrl(['record' => $record->sourceTicket]))
                                                                    ->weight('semibold'),

                                                                TextEntry::make('targetTicket.title')
                                                                    ->label('Title')
                                                                    ->limit(50)
                                                                    ->tooltip(fn (TicketLink $record) => $record->targetTicket->title),

                                                                TextEntry::make('targetTicket.status.name')
                                                                    ->label('Status')
                                                                    ->badge()
                                                                    ->color(fn (TicketLink $record) => $record->targetTicket->status->category->getColor()),
                                                            ])
                                                            ->columns(4)
                                                            ->visible(fn (Ticket $record) => $record->outwardLinks->isNotEmpty()),

                                                        // Inward links
                                                        RepeatableEntry::make('inwardLinks')
                                                            ->label('')
                                                            ->schema([
                                                                TextEntry::make('linkType.inward_description')
                                                                    ->label('Relationship')
                                                                    ->badge()
                                                                    ->color('warning')
                                                                    ->icon('heroicon-o-arrow-left'),

                                                                TextEntry::make('sourceTicket.code')
                                                                    ->label('Ticket')
                                                                    ->badge()
                                                                    ->color('gray')
                                                                    ->url(fn (TicketLink $record) => ViewTicket::getUrl(['record' => $record->sourceTicket]))
                                                                    ->weight('semibold'),

                                                                TextEntry::make('sourceTicket.title')
                                                                    ->label('Title')
                                                                    ->limit(50)
                                                                    ->tooltip(fn (TicketLink $record) => $record->sourceTicket->title),

                                                                TextEntry::make('sourceTicket.status.name')
                                                                    ->label('Status')
                                                                    ->badge()
                                                                    ->color(fn (TicketLink $record) => $record->sourceTicket->status->category->getColor()),
                                                            ])
                                                            ->columns(4)
                                                            ->visible(fn (Ticket $record) => $record->inwardLinks->isNotEmpty()),
                                                    )
                                                    ->toArray()
                                            ),
                                    ])
                                    ->collapsible()
                                    ->collapsed(false)
                                    ->visible(fn (Ticket $record) => $record->outwardLinks->isNotEmpty() ||
                                        $record->inwardLinks->isNotEmpty()
                                    ),

                                Section::make('Comments')
                                    ->schema([
                                        CommentsEntry::make('comments')
                                            ->hiddenLabel()
                                            ->disableSidebar()
                                            ->mentionables(fn (Model $record) => User::all()),
                                    ])
                                    ->collapsible()
                                    ->collapsed(false),
                            ])
                            ->columnSpan([
                                'default' => 1,
                                'md' => 3,
                            ]),

                        // Sidebar (right side - 1 column)
                        Section::make('Details')
                            ->schema([
                                TextEntry::make('code')
                                    ->label('Ticket ID')
                                    ->badge()
                                    ->color('gray'),

                                TextEntry::make('status.name')
                                    ->label('Status')
                                    ->badge()
                                    ->color(fn (Ticket $record) => $record->status->category->getColor()),

                                TextEntry::make('priority.name')
                                    ->label('Priority')
                                    ->icon(fn (Ticket $record) => $record->priority->icon)
                                    ->iconColor(fn (Ticket $record) => $record->priority->color)
                                    ->extraAttributes(fn (Ticket $record) => [
                                        'style' => 'color: '.$record->priority?->color.'; border-color: '.$record->priority?->color.'; background-color: transparent; font-weight: 600;',
                                    ]),

                                TextEntry::make('type.name')
                                    ->label('Type')
                                    ->icon(fn (Ticket $record) => $record->type->icon),

                                TextEntry::make('owner.name')
                                    ->label('Reporter')
                                    ->icon('heroicon-o-user'),

                                TextEntry::make('responsible.name')
                                    ->label('Assignee')
                                    ->icon('heroicon-o-user-circle')
                                    ->placeholder('Unassigned')
                                    ->color(fn ($state) => $state ? 'primary' : 'gray'),

                                TextEntry::make('project.name')
                                    ->label('Project')
                                    ->icon('heroicon-o-folder'),

                                TextEntry::make('created_at')
                                    ->label('Created')
                                    ->dateTime()
                                    ->icon('heroicon-o-clock'),

                                TextEntry::make('updated_at')
                                    ->label('Updated')
                                    ->dateTime()
                                    ->icon('heroicon-o-arrow-path')
                                    ->color('gray'),

                                TextEntry::make('deleted_at')
                                    ->label('Deleted')
                                    ->dateTime()
                                    ->icon('heroicon-o-trash')
                                    ->color('danger')
                                    ->visible(fn (Ticket $record): bool => $record->trashed()),
                            ])
                            ->columnSpan([
                                'default' => 1,
                                'md' => 1,
                            ]),
                    ]),
            ]);
    }
}
