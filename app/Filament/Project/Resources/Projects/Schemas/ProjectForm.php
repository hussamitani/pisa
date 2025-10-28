<?php

declare(strict_types=1);

namespace App\Filament\Project\Resources\Projects\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Wizard\Step::make(__('Project'))->schema([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('ticket_prefix')
                            ->regex('/[A-Z]{3,}/')
                            ->required(),
                        Textarea::make('description')
                            ->default(null)
                            ->columnSpanFull(),
                    ])->columns(2),
                    Wizard\Step::make(__('Settings'))->schema([
                        Select::make('ticket_type_scheme_id')
                            ->relationship('ticketTypeScheme', 'name')
                            ->required(),
                        Select::make('ticket_priority_scheme_id')
                            ->relationship('ticketPriorityScheme', 'name')
                            ->required(),
                        Select::make('ticket_status_scheme_id')
                            ->relationship('ticketStatusScheme', 'name')
                            ->required(),
                    ])->columns(3),
                ]),
            ])->columns(1);
    }
}
