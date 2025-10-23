<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\TicketLink\Resources\TicketLinkTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TicketLinkTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('inward_description')
                    ->required(),
                TextInput::make('outward_description')
                    ->required(),
                Toggle::make('is_system')
                    ->required(),
                Toggle::make('is_hierarchical')
                    ->required(),
            ]);
    }
}
