<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\TicketType\Resources\TicketTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Guava\IconPicker\Forms\Components\IconPicker;

class TicketTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                IconPicker::make('icon')
                    ->sets(['heroicons'])
                    ->iconsSearchResults()
                    ->required(),
            ]);
    }
}
