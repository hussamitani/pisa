<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\TicketType\Resources\TicketTypes\Pages;

use App\Filament\Settings\Clusters\TicketType\Resources\TicketTypes\TicketTypeResource;
use Filament\Pages\Concerns\HasSubNavigation;
use Filament\Resources\Pages\CreateRecord;

class CreateTicketType extends CreateRecord
{
    use HasSubNavigation;

    protected static string $resource = TicketTypeResource::class;
}
