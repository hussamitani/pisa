<?php

declare(strict_types=1);

namespace App\Filament\Project\Resources\Projects\Pages;

use App\Filament\App\Resources\Tickets\Pages\ListTickets;
use App\Filament\Project\Resources\Projects\ProjectResource;
use App\Models\Project;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\ViewRecord;

/**
 * @property-read Project $record
 */
class ViewProject extends ViewRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make('tickets')->url(
                ListTickets::getUrl(
                    parameters: ['tenant' => $this->record],
                    panel: 'app',
                )
            ),
            EditAction::make(),
        ];
    }
}
