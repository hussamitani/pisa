<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\Priority\Resources\TicketPrioritySchemes\RelationManagers;

use App\Filament\Settings\Clusters\Priority\Resources\TicketPriorities\TicketPriorityResource;
use App\Models\TicketPriority;
use Filament\Actions\AttachAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class PrioritiesRelationManager extends RelationManager
{
    protected static string $relationship = 'priorities';

    protected static ?string $inverseRelationship = 'schemes';

    protected static ?string $relatedResource = TicketPriorityResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('position')
            ->headerActions([
                AttachAction::make()
                    ->recordTitle(fn (TicketPriority $priority) => $priority->name)
                    ->multiple()
                    ->preloadRecordSelect(),
            ]);
    }
}
