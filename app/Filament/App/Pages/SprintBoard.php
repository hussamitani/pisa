<?php

declare(strict_types=1);

namespace App\Filament\App\Pages;

use App\Filament\App\Resources\Tickets\Pages\CreateTicket;
use App\Models\Project;
use App\Models\Sprint;
use App\Models\Ticket;
use App\Models\TicketStatus;
use Filament\Actions\CreateAction;
use Filament\Facades\Filament;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use Relaticle\Flowforge\Board;
use Relaticle\Flowforge\BoardPage;
use Relaticle\Flowforge\Column;

class SprintBoard extends BoardPage
{
    protected static string|null|\BackedEnum $navigationIcon = Heroicon::OutlinedMap;

    protected static ?string $navigationLabel = 'Sprint Board';

    protected static ?string $title = 'Sprint Board';

    protected Width|string|null $maxContentWidth = Width::Full;

    public static function isDiscovered(): bool
    {
        return Sprint::query()->exists();
    }

    public static function shouldRegisterNavigation(): bool
    {
        /** @var Project $project */
        $project = Filament::getTenant();

        return $project->sprints()->exists();
    }

    public function board(Board $board): Board
    {
        /** @var Project $project */
        $project = Filament::getTenant();

        $statuses = $project->ticketStatusScheme->statuses;
        $statusColumns = $statuses->map(function (TicketStatus $status) {
            return Column::make((string) $status->id)->label($status->name)->color($status->category->getColor());
        });

        return $board
            ->query($this->getEloquentQuery())
            ->recordTitleAttribute('title')
            ->columnIdentifier('status_id')
            ->positionIdentifier('position')
            ->columns($statusColumns->toArray())
            ->cardSchema(fn (Schema $schema) => $schema->components([
                Grid::make(3)->schema([
                    TextEntry::make('type.name')
                        ->label(__('Type'))
                        ->icon(fn (Ticket $record) => $record->type->icon)
                        ->size(TextSize::Small)
                        ->color(fn (Ticket $record) => $record->type->color),
                    TextEntry::make('status.name')
                        ->label(__('Status'))
                        ->size(TextSize::Small)
                        ->badge()
                        ->color(fn (Ticket $record) => $record->status->category->getColor()),
                    TextEntry::make('priority.name')
                        ->label('Priority')
                        ->icon(fn (Ticket $record) => $record->priority->icon)
                        ->iconColor(fn (Ticket $record) => $record->priority->color)
                        ->extraAttributes(fn (Ticket $record) => [
                            'style' => 'color: '.$record->priority?->color.'; border-color: '.$record->priority?->color.'; background-color: transparent; font-weight: 600;',
                        ]),
                ]),
                Grid::make(2)->schema([
                    TextEntry::make('responsible.name')
                        ->label(__('Responsible'))
                        ->placeholder(__('Unassigned'))
                        ->size(TextSize::Small)
                        ->color('gray')
                        ->icon('heroicon-o-user'),
                    TextEntry::make('created_at')
                        ->label(__('Created'))
                        ->date('d.m.Y')
                        ->size(TextSize::Small)
                        ->color('gray')
                        ->icon('heroicon-o-calendar'),
                ]),
            ]));
    }

    public function getEloquentQuery(): Builder
    {
        /** @var Project $project */
        $project = Filament::getTenant();

        /** @var Sprint $sprint */
        $sprint = $project->sprints->last();

        return $sprint->tickets()->getQuery();
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->url(CreateTicket::getUrl()),
        ];
    }
}
