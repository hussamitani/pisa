<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\Status\Resources\TicketStatusSchemes\Pages;

use App\Filament\Settings\Clusters\Status\Resources\TicketStatusSchemes\TicketStatusSchemeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTicketStatusScheme extends CreateRecord
{
    use \Filament\Pages\Concerns\HasSubNavigation;

    protected static string $resource = TicketStatusSchemeResource::class;
}
