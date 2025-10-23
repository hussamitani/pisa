<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\Priority\Resources\TicketPrioritySchemes\Pages;

use App\Filament\Settings\Clusters\Priority\Resources\TicketPrioritySchemes\TicketPrioritySchemeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTicketPriorityScheme extends ViewRecord
{
    use \Filament\Pages\Concerns\HasSubNavigation;

    protected static string $resource = TicketPrioritySchemeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
