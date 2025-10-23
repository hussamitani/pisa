<?php

namespace App\Filament\Pages;

use App\Filament\App\Resources\Tickets\Pages\CreateTicket;
use App\Filament\App\Resources\Tickets\Schemas\TicketForm;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\TicketStatus;
use Filament\Actions\CreateAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Relaticle\Flowforge\Board;
use Relaticle\Flowforge\BoardPage;
use Relaticle\Flowforge\Column;

class TicketBoard extends BoardPage
{
    protected static string|null|\BackedEnum $navigationIcon = 'heroicon-o-view-columns';
    protected static ?string $navigationLabel = 'Task Board';
    protected static ?string $title = 'Ticket Board';

    public function board(Board $board): Board
    {
        /** @var Project $project */
        $project = Filament::getTenant();

        $statuses = $project->ticketStatusScheme->statuses;
        $statusColumns = $statuses->map(function (TicketStatus $status) {
            return Column::make($status->id)->label($status->name)->color($status->category->getColor());
        });

        return $board
            ->query($this->getEloquentQuery())
            ->recordTitleAttribute('title')
            ->columnIdentifier('status_id')
            ->positionIdentifier('position')
            ->columns($statusColumns->toArray());
    }

    public function getEloquentQuery(): Builder
    {
        /** @var Project $project */
        $project = Filament::getTenant();
        return $project->tickets()->getQuery();
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->url(CreateTicket::getUrl())
        ];
    }
}
