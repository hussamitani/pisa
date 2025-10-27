<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\Status\Resources\TicketStatusSchemes\RelationManagers;

use App\Filament\Settings\Clusters\Status\Resources\TicketStatuses\TicketStatusResource;
use App\Models\TicketStatus;
use Filament\Actions\AttachAction;
use Filament\Actions\DetachAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class StatusesRelationManager extends RelationManager
{
    protected static string $relationship = 'statuses';

    protected static ?string $inverseRelationship = 'schemes';

    protected static ?string $relatedResource = TicketStatusResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('position')
            ->headerActions([
                AttachAction::make()
                    ->recordTitle(fn (TicketStatus $record) => $record->name)
                    ->preloadRecordSelect()
                    ->multiple(),
            ])
            ->recordActions([
                DetachAction::make(),
            ]);
    }
}
