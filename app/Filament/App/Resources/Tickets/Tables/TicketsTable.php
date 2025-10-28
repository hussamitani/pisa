<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Tickets\Tables;

use App\Models\TicketPriority;
use App\Models\TicketStatus;
use App\Models\TicketType;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class TicketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->badge()
                    ->searchable(),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('owner.name')
                    ->searchable(),
                TextColumn::make('responsible.name')
                    ->searchable(),
                TextColumn::make('type')
                    ->icon(fn (TicketType $state) => $state->getIcon())
                    ->formatStateUsing(fn (TicketType $state) => $state->getLabel())
                    ->searchable(),
                TextColumn::make('status')
                    ->formatStateUsing(fn (TicketStatus $state) => $state->name)
                    ->color(fn (TicketStatus $state) => $state->category->getColor())
                    ->searchable(),
                TextColumn::make('priority')
                    ->badge()
                    ->color(fn (TicketPriority $state) => Color::hex($state->color))
                    ->formatStateUsing(fn (TicketPriority $state) => $state->name)
                    ->icon(fn (TicketPriority $state) => $state->icon)
                    ->searchable(),
                TextColumn::make('sprint.name')
                    ->label(__('Sprint')),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
            ]);
    }
}
