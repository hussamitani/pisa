<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\TicketType\Resources\TicketTypeSchemes\RelationManagers;

use App\Filament\Settings\Clusters\TicketType\Resources\TicketTypes\TicketTypeResource;
use App\Models\TicketType;
use Filament\Actions\AttachAction;
use Filament\Actions\DetachAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class TypesRelationManager extends RelationManager
{
    protected static string $relationship = 'ticketTypes';

    protected static ?string $inverseRelationship = 'schemes';

    protected static ?string $relatedResource = TicketTypeResource::class;

    protected static ?string $recordTitleAttribute = 'name';

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('position')
            ->recordActions([
                DetachAction::make(),
            ])
            ->headerActions([
                AttachAction::make()
                    ->recordTitle(fn (TicketType $record): string => $record->name)
                    ->multiple()
                    ->preloadRecordSelect(),
            ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}
