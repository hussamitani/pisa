<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\TicketType\Resources\TicketTypeSchemes\Pages;

use App\Filament\Settings\Clusters\TicketType\Resources\TicketTypeSchemes\TicketTypeSchemeResource;
use Filament\Pages\Concerns\HasSubNavigation;
use Filament\Resources\Pages\CreateRecord;

class CreateTicketTypeScheme extends CreateRecord
{
    use HasSubNavigation;

    protected static string $resource = TicketTypeSchemeResource::class;
}
