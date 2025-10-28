<?php

declare(strict_types=1);

namespace App\Filament\Project\Resources\Projects\Pages;

use App\Filament\App\Pages\ProjectBoard;
use App\Filament\App\Resources\Sprints\Pages\ListSprints;
use App\Filament\App\Resources\Tickets\Pages\ListTickets;
use App\Filament\Project\Resources\Projects\ProjectResource;
use App\Livewire\LinkWidget;
use App\Models\Project;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Icons\Heroicon;

/**
 * @property-read Project $record
 */
class ViewProject extends ViewRecord
{
    protected static string $resource = ProjectResource::class;

    public function getTitle(): string
    {
        return $this->record->name;
    }

    public function getHeaderWidgetsColumns(): int|array
    {
        return 3;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            LinkWidget::to(
                ListTickets::getUrl(['tenant' => $this->record], panel: 'app'),
                __('Tickets'),
                trans('resource.tickets.link.description'),
                __('Tickets'),
                Heroicon::OutlinedTicket,
            ),
            LinkWidget::to(
                ProjectBoard::getUrl(['tenant' => $this->record], panel: 'app'),
                __('Board'),
                trans('resource.board.link.description'),
                __('Board'),
                Heroicon::OutlinedViewColumns
            ),
            LinkWidget::to(
                ListSprints::getUrl(['tenant' => $this->record], panel: 'app'),
                __('Sprints'),
                trans('resource.sprints.link.description'),
                __('Sprints'),
                Heroicon::Bolt
            ),

        ];
    }

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
