<?php

declare(strict_types=1);

namespace App\Filament\App\Widgets;

use App\Models\Project;
use App\Models\Sprint;
use App\Models\Ticket;
use App\Models\TicketPriority;
use App\Models\TicketStatus;
use App\Models\TicketType;
use Filament\Facades\Filament;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class SprintTable extends TableWidget
{
    protected $listeners = ['refresh-all-tables' => '$refresh'];

    public ?int $sprintId = null;

    public ?Sprint $sprint = null;

    public function mount($sprintId): void
    {
        $this->sprintId = $sprintId;
        $this->sprint = $sprintId ? Sprint::find($sprintId) : null;
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading($this->sprint ? $this->sprint->name : 'Backlog')
            ->description($this->getDescription())
            ->query(fn (): Builder => Ticket::query()->when($this->sprintId, fn (Builder $query) => $query->where('sprint_id', $this->sprintId), fn (Builder $query) => $query->whereNull('sprint_id')))
            ->columns([
                TextColumn::make('code')
                    ->badge()
                    ->sortable(),
                TextColumn::make('title')
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
                            ->toArray();
                    })
                    ->placeholder('Backlog')
                    ->afterStateUpdated(function (Ticket $record, $state) {
                        $record->update(['sprint_id' => $state]);
                        $this->dispatch('refresh-all-tables');
                    }),
                SelectColumn::make('story_points')
                    ->label(__('Story Points'))
                    ->summarize(Sum::make())
                    ->options([0 => 0, 1 => 1, 2 => 2, 3 => 3, 5 => 5, 8 => 8, 13 => 13, 20 => 20, 40 => 40]),
                TextColumn::make('responsible.name')
                    ->placeholder('Unassigned')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->toggleable(true, isToggledHiddenByDefault: true)
                    ->date('d.m.Y')
                    ->sortable(),
            ])
            ->defaultSort('sprint_position')
            ->reorderable('sprint_position')
            ->striped()
            ->paginated(false);
    }

    private function getDescription(): ?string
    {
        if (! $this->sprint) {
            return null;
        }

        return sprintf('%s - %s | %s', $this->sprint->begins_at->format('d.m.Y'), $this->sprint->ends_at->format('d.m.Y'), $this->sprint->description);
    }
}
