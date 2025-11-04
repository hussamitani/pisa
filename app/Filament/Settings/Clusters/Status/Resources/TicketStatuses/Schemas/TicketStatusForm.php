<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\Status\Resources\TicketStatuses\Schemas;

use App\Enum\TicketStatusCategory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TicketStatusForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('category')
                    ->required()
                    ->options(TicketStatusCategory::class),
            ]);
    }
}
