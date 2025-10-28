<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\TicketLink\Resources\TicketLinkTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class TicketLinkTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->description('Define the name and behavior of this link type')
                    ->icon('heroicon-o-link')
                    ->schema([
                        TextInput::make('name')
                            ->label('Link Type Name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Blocks, Relates to, Duplicates')
                            ->helperText('A short, descriptive name for this link type')
                            ->columnSpanFull(),
                    ]),

                Section::make('Link Descriptions')
                    ->description('Define how this link appears from different perspectives')
                    ->icon('heroicon-o-arrow-path-rounded-square')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('outward_description')
                                    ->label('Outward Description')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('e.g., blocks, relates to, duplicates')
                                    ->helperText('Description when viewing from the source ticket')
                                    ->suffixIcon(Heroicon::OutlinedForward),

                                TextInput::make('inward_description')
                                    ->label('Inward Description')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('e.g., is blocked by, relates to, is duplicated by')
                                    ->helperText('Description when viewing from the target ticket')
                                    ->prefixIcon(Heroicon::OutlinedBackward),
                            ]),
                    ]),
            ]);
    }
}
