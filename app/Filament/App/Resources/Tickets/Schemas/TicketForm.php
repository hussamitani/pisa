<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Tickets\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('code')
                    ->required(),
                Select::make('owner_id')
                    ->relationship('owner', 'name')
                    ->required(),
                Select::make('responsible_id')
                    ->relationship('responsible', 'name')
                    ->default(null),
                Select::make('project_id')
                    ->relationship('project', 'name')
                    ->required(),
                Select::make('type_id')
                    ->relationship('type', 'name')
                    ->required(),
                Select::make('status_id')
                    ->relationship('status', 'name')
                    ->required(),
                Select::make('priority_id')
                    ->relationship('priority', 'name')
                    ->required(),
            ]);
    }
}
