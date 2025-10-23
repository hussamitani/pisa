<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\Priority\Resources\TicketPriorities\Pages;

use App\Filament\Settings\Clusters\Priority\Resources\TicketPriorities\TicketPriorityResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTicketPriority extends CreateRecord
{
    use \Filament\Pages\Concerns\HasSubNavigation;

    protected static string $resource = TicketPriorityResource::class;
}
