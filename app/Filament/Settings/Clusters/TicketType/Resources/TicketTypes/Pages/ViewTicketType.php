<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\TicketType\Resources\TicketTypes\Pages;

use App\Filament\Settings\Clusters\TicketType\Resources\TicketTypes\TicketTypeResource;
use Filament\Actions\EditAction;
use Filament\Pages\Concerns\HasSubNavigation;
use Filament\Resources\Pages\ViewRecord;

class ViewTicketType extends ViewRecord
{
    use HasSubNavigation;

    protected static string $resource = TicketTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
