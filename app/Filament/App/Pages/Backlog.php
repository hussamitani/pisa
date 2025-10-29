<?php

declare(strict_types=1);

namespace App\Filament\App\Pages;

use App\Filament\App\Resources\Tickets\Pages\CreateTicket;
use App\Filament\App\Widgets\SprintTable;
use App\Models\Project;
use App\Models\Ticket;
use BackedEnum;
use Filament\Actions\CreateAction;
use Filament\Facades\Filament;
use Filament\Pages\Page;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;

class Backlog extends Page
{
    protected $listeners = ['sprint-updated' => '$refresh'];

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQueueList;

    protected static ?int $navigationSort = 5;

    protected Width|string|null $maxContentWidth = Width::Full;

    public function getTitle(): string
    {
        return 'Backlog';
    }

    public function getHeaderWidgetsColumns(): int|array
    {
        return 1;
    }

    protected function getHeaderWidgets(): array
    {
        /** @var Project $project */
        $project = Filament::getTenant();

        $sprints = $project->sprints()->with('tickets')->get();

        $widgets = [];

        // Add sprint tables
        foreach ($sprints as $sprint) {
            $widgets[] = SprintTable::make(['sprintId' => $sprint->id]);
        }

        // Add backlog table (tickets with null sprint_id)
        $widgets[] = SprintTable::make(['sprintId' => null]);

        return $widgets;
    }

    public function changeTicketSprint(int $ticketId, ?string $sprintId): void
    {
        $ticket = Ticket::findOrFail($ticketId);

        $ticket->update([
            'sprint_id' => $sprintId ?: null,
        ]);

        $this->dispatch('$refresh');
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make('create-ticket')
                ->label('Create Ticket')
                ->url(CreateTicket::getUrl()),
        ];
    }
}
