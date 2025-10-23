<?php

namespace App\Filament\Project\Resources\Projects\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('ticket_prefix')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('ticket_type_scheme_id')
                    ->relationship('ticketTypeScheme', 'name')
                    ->required(),
                Select::make('ticket_priority_scheme_id')
                    ->relationship('ticketPriorityScheme', 'name')
                    ->required(),
                Select::make('ticket_status_scheme_id')
                    ->relationship('ticketStatusScheme', 'name')
                    ->required(),
            ]);
    }
}
