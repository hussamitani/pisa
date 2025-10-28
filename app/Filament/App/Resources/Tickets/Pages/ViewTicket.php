<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Tickets\Pages;

use App\Filament\App\Resources\Tickets\TicketResource;
use App\Models\Ticket;
use App\Models\TicketLink;
use App\Models\TicketLinkType;
use App\Models\TicketStatus;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Kirschbaum\Commentions\Filament\Actions\SubscriptionAction;

/**
 * @property-read Ticket $record
 */
class ViewTicket extends ViewRecord
{
    protected static string $resource = TicketResource::class;

    public function getTitle(): string|Htmlable
    {
        return $this->record->title;
    }

    protected function getHeaderActions(): array
    {
        $statuses = $this->record->project->ticketStatusScheme->statuses
            ->except($this->record->status->id);

        $statusActions = $statuses->map(function (TicketStatus $status) {
            return Action::make("status_{$status->id}")
                ->label($status->name)
                ->icon(Heroicon::OutlinedArrowRightCircle)
                ->color($status->category->getColor())
                ->requiresConfirmation()
                ->action(function () use ($status) {
                    $this->record->update([
                        'status_id' => $status->id,
                    ]);

                    Notification::make()
                        ->success()
                        ->title('Status Updated')
                        ->body("Ticket status changed to {$status->name}")
                        ->send();

                    $this->record->refresh();
                    $this->redirect(ViewTicket::getUrl(['record' => $this->record]));
                });
        })->values()->all();

        return [
            Action::make('linkTicket')
                ->label('Link Ticket')
                ->icon('heroicon-o-link')
                ->color('gray')
                ->schema([
                    Select::make('link_direction')
                        ->label('Relationship')
                        ->options(function () {
                            return TicketLinkType::all()
                                ->flatMap(fn (TicketLinkType $type) => [
                                    "outward_{$type->id}" => "→ {$type->outward_description}",
                                    "inward_{$type->id}" => "← {$type->inward_description}",
                                ]);
                        })
                        ->required()
                        ->searchable()
                        ->helperText('Choose how this ticket relates to the other ticket'),

                    Select::make('target_ticket_id')
                        ->label('Ticket')
                        ->searchable()
                        ->required()
                        ->getSearchResultsUsing(fn (string $search, Ticket $record) => Ticket::where('id', '!=', $record->id)
                            ->where('title', 'like', "%{$search}%")
                            ->limit(50)
                            ->pluck('title', 'id')
                        )
                        ->getOptionLabelUsing(fn ($value) => Ticket::find($value)?->title
                        ),
                ])
                ->action(function (array $data, Ticket $record): void {
                    [$direction, $linkTypeId] = explode('_', $data['link_direction']);

                    if ($direction === 'outward') {
                        TicketLink::create([
                            'source_ticket_id' => $record->id,
                            'target_ticket_id' => $data['target_ticket_id'],
                            'ticket_link_type_id' => $linkTypeId,
                        ]);
                    } else {
                        TicketLink::create([
                            'source_ticket_id' => $data['target_ticket_id'],
                            'target_ticket_id' => $record->id,
                            'ticket_link_type_id' => $linkTypeId,
                        ]);
                    }

                    Notification::make()
                        ->success()
                        ->title('Ticket linked successfully')
                        ->send();
                }),
            EditAction::make(),
            SubscriptionAction::make(),
            ActionGroup::make($statusActions)
                ->label(__('Toggle status'))
                ->icon(Heroicon::Bolt)
                ->color('primary')
                ->button(),
        ];
    }
}
