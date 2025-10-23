<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\TicketLink\Resources\TicketLinkTypes\Pages;

use App\Filament\Settings\Clusters\TicketLink\Resources\TicketLinkTypes\TicketLinkTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTicketLinkTypes extends ListRecords
{
    protected static string $resource = TicketLinkTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
