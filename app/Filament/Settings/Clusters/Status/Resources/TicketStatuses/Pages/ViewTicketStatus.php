<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\Status\Resources\TicketStatuses\Pages;

use App\Filament\Settings\Clusters\Status\Resources\TicketStatuses\TicketStatusResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTicketStatus extends ViewRecord
{
    use \Filament\Pages\Concerns\HasSubNavigation;

    protected static string $resource = TicketStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
