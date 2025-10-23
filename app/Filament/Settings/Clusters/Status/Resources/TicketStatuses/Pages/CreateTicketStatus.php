<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\Status\Resources\TicketStatuses\Pages;

use App\Filament\Settings\Clusters\Status\Resources\TicketStatuses\TicketStatusResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTicketStatus extends CreateRecord
{
    use \Filament\Pages\Concerns\HasSubNavigation;

    protected static string $resource = TicketStatusResource::class;
}
