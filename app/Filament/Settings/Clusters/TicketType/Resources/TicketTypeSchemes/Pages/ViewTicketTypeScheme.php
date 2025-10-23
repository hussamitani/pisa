<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\TicketType\Resources\TicketTypeSchemes\Pages;

use App\Filament\Settings\Clusters\TicketType\Resources\TicketTypeSchemes\TicketTypeSchemeResource;
use Filament\Actions\EditAction;
use Filament\Pages\Concerns\HasSubNavigation;
use Filament\Resources\Pages\ViewRecord;

class ViewTicketTypeScheme extends ViewRecord
{
    use HasSubNavigation;

    protected static string $resource = TicketTypeSchemeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
