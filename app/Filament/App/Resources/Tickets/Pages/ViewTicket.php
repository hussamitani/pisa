<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Tickets\Pages;

use App\Filament\App\Resources\Tickets\TicketResource;
use App\Models\Ticket;
use App\Models\TicketStatus;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\EditAction;
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
                ->color(match ($status->name) {
                    'Open' => 'info',
                    'In Progress' => 'warning',
                    'Done' => 'success',
                    'Closed' => 'gray',
                    default => 'gray',
                })
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
