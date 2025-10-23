<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\Status\Resources\TicketStatusSchemes\Pages;

use App\Filament\Settings\Clusters\Status\Resources\TicketStatusSchemes\TicketStatusSchemeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTicketStatusSchemes extends ListRecords
{
    protected static string $resource = TicketStatusSchemeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
