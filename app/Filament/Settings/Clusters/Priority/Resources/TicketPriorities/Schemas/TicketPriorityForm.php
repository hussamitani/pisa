<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\Priority\Resources\TicketPriorities\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Guava\IconPicker\Forms\Components\IconPicker;

class TicketPriorityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                ColorPicker::make('color'),
                IconPicker::make('icon')
                    ->sets(['heroicons'])
                    ->iconsSearchResults()
                    ->required(),
            ]);
    }
}
