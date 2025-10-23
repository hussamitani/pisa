<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\Status\Resources\TicketStatusSchemes\Pages;

use App\Filament\Settings\Clusters\Status\Resources\TicketStatusSchemes\TicketStatusSchemeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTicketStatusScheme extends ViewRecord
{
    use \Filament\Pages\Concerns\HasSubNavigation;

    protected static string $resource = TicketStatusSchemeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
