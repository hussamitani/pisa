<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\Priority\Resources\TicketPrioritySchemes\Pages;

use App\Filament\Settings\Clusters\Priority\Resources\TicketPrioritySchemes\TicketPrioritySchemeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTicketPriorityScheme extends CreateRecord
{
    use \Filament\Pages\Concerns\HasSubNavigation;

    protected static string $resource = TicketPrioritySchemeResource::class;
}
