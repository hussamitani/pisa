<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Sprints\Tables;

use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SprintsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('description'),
                TextColumn::make('begins_at')
                    ->date('d.m.Y'),
                TextColumn::make('ends_at')
                    ->date('d.m.Y'),
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
                //
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Board')
                    ->icon('heroicon-o-square-3-stack-3d'),
                EditAction::make(),
            ])
            ->toolbarActions([
            ]);
    }
}
