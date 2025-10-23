<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\TicketLink\Resources\TicketLinkTypes\Pages;

use App\Filament\Settings\Clusters\TicketLink\Resources\TicketLinkTypes\TicketLinkTypeResource;
use Filament\Pages\Concerns\HasSubNavigation;
use Filament\Resources\Pages\CreateRecord;

class CreateTicketLinkType extends CreateRecord
{
    use HasSubNavigation;

    protected static string $resource = TicketLinkTypeResource::class;
}
