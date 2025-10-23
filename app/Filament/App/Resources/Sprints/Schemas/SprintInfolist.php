<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Sprints\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SprintInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
