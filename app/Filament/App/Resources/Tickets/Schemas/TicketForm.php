<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Tickets\Schemas;

use Filament\Facades\Filament;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('Ticket'))
                    ->columnSpan(3)
                    ->columns(3)
                    ->schema([
                        TextInput::make('title')
                            ->columnSpan(2)
                            ->required(),
                        Select::make('type_id')
                            ->label(__('Type'))
                            ->searchable()
                            ->preload()
                            ->options(fn () => Filament::getTenant()->ticketTypeScheme?->ticketTypes->pluck('name', 'id') ?? [])
                            ->required(),
                        RichEditor::make('description')
                            ->columnSpanFull(),
                    ]),
                Section::make(__('Settings'))
                    ->columnSpan(1)
                    ->schema([
                        Select::make('responsible_id')
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->relationship('responsible', 'name')
                            ->default(null),
                        Select::make('status_id')
                            ->label(__('Status'))
                            ->searchable()
                            ->preload()
                            ->options(fn () => Filament::getTenant()->ticketStatusScheme?->statuses->pluck('name', 'id') ?? [])
                            ->required(),
                        Select::make('priority_id')
                            ->label(__('Priority'))
                            ->searchable()
                            ->preload()
                            ->options(fn () => Filament::getTenant()->ticketPriorityScheme?->priorities->pluck('name', 'id') ?? [])
                            ->required(),
                        Select::make('sprint_id')
                            ->visible(fn () => Filament::getTenant()->sprints()->exists())
                            ->label(__('Sprint'))
                            ->searchable()
                            ->preload()
                            ->options(fn () => Filament::getTenant()->sprints->pluck('name', 'id') ?? []),
                    ]),
                Hidden::make('owner_id')
                    ->default(auth()->user()->id),
                Hidden::make('project_id')
                    ->default(Filament::getTenant()->id),

            ])->columns(4);
    }
}
