<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\TicketType\Resources\TicketTypeSchemes\Pages;

use App\Filament\Settings\Clusters\TicketType\Resources\TicketTypeSchemes\TicketTypeSchemeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTicketTypeSchemes extends ListRecords
{
    protected static string $resource = TicketTypeSchemeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
