<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\Priority\Resources\TicketPrioritySchemes\Pages;

use App\Filament\Settings\Clusters\Priority\Resources\TicketPrioritySchemes\TicketPrioritySchemeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTicketPrioritySchemes extends ListRecords
{
    protected static string $resource = TicketPrioritySchemeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
