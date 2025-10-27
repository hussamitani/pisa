<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Tickets\Schemas;

use App\Models\Ticket;
use App\Models\User;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
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
                                    ->icon(fn (Ticket $record) => match ($record->type?->name) {
                                        'Bug' => 'heroicon-o-bug-ant',
                                        'Feature' => 'heroicon-o-star',
                                        'Task' => 'heroicon-o-check-circle',
                                        default => 'heroicon-o-document-text',
                                    }),

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
