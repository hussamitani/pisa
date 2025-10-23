<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\TicketLink\Resources\TicketLinkTypes\Pages;

use App\Filament\Settings\Clusters\TicketLink\Resources\TicketLinkTypes\TicketLinkTypeResource;
use Filament\Actions\EditAction;
use Filament\Pages\Concerns\HasSubNavigation;
use Filament\Resources\Pages\ViewRecord;

class ViewTicketLinkType extends ViewRecord
{
    use HasSubNavigation;

    protected static string $resource = TicketLinkTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
