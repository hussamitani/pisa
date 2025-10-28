<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Project;
use App\Models\Sprint;
use App\Models\Ticket;
use App\Models\TicketPriority;
use App\Models\TicketStatus;
use App\Models\TicketType;
use Filament\Facades\Filament;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class SprintTicketsTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    public Sprint $sprint;

    public function mount(Sprint $sprint): void
    {
        $this->sprint = $sprint;
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
                    ->afterStateUpdated(function (Ticket $record, $state) {
                        $record->update(['sprint_id' => $state]);
                        $this->dispatch('sprint-updated');
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
            ->paginated(false)
            ->emptyStateHeading('No tickets in this sprint')
            ->emptyStateDescription('Use the dropdown to move tickets to this sprint.')
            ->emptyStateIcon('heroicon-o-inbox');
    }

    public function getTableQuery(): Builder
    {
        return $this->sprint->tickets()->getQuery();
    }

    public function render()
    {
        return view('livewire.sprint-tickets-table');
    }
}
