<?php

declare(strict_types=1);

namespace App\Filament\App\Pages;

use App\Filament\App\Resources\Tickets\Pages\CreateTicket;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\TicketPriority;
use App\Models\TicketStatus;
use App\Models\TicketType;
use BackedEnum;
use Filament\Actions\CreateAction;
use Filament\Facades\Filament;
use Filament\Pages\Page;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class Backlog extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQueueList;

    protected static ?int $navigationSort = 5;

    protected string $view = 'filament.app.pages.backlog';

    protected Width|string|null $maxContentWidth = Width::Full;

    public function getTitle(): string
    {
        return 'Backlog';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->columns([
                TextColumn::make('code')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->icon(fn (TicketType $state) => $state->getIcon())
                    ->formatStateUsing(fn (TicketType $state) => $state->getLabel())
                    ->sortable(),
                TextColumn::make('status')
                    ->formatStateUsing(fn (TicketStatus $state) => $state->name)
                    ->color(fn (TicketStatus $state) => $state->category->getColor())
                    ->badge()
                    ->sortable(),
                TextColumn::make('priority')
                    ->badge()
                    ->color(fn (TicketPriority $state) => Color::hex($state->color))
                    ->formatStateUsing(fn (TicketPriority $state) => $state->name)
                    ->icon(fn (TicketPriority $state) => $state->icon)
                    ->sortable(),
                SelectColumn::make('sprint_id')
                    ->label('Sprint')
                    ->options(function () {
                        /** @var Project $project */
                        $project = Filament::getTenant();

                        return $project->sprints()
                            ->pluck('name', 'id')
                            ->prepend('Backlog', null)
                            ->toArray();
                    })
                    ->placeholder('Backlog')
                    ->afterStateUpdated(function (Ticket $record, $state) {
                        $record->update(['sprint_id' => $state]);
                        $this->dispatch('$refresh');
                    }),
                TextColumn::make('responsible.name')
                    ->placeholder('Unassigned')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->date('d.m.Y')
                    ->sortable(),
            ])
            ->defaultSort('sprint_position')
            ->reorderable('sprint_position')
            ->striped()
            ->paginated(false);
    }

    public function getTableQuery(): Builder
    {
        /** @var Project $project */
        $project = Filament::getTenant();

        return Ticket::query()
            ->where('project_id', $project->id)
            ->whereNull('sprint_id');
    }

    public function getSprints(): Collection
    {
        /** @var Project $project */
        $project = Filament::getTenant();

        return $project->sprints()
            ->with(['tickets' => function ($query) {
                $query->orderBy('position');
            }])
            ->orderBy('begins_at')
            ->get();
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
