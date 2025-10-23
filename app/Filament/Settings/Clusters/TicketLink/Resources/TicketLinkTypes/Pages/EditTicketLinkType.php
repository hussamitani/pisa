<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\TicketLink\Resources\TicketLinkTypes\Pages;

use App\Filament\Settings\Clusters\TicketLink\Resources\TicketLinkTypes\TicketLinkTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Pages\Concerns\HasSubNavigation;
use Filament\Resources\Pages\EditRecord;

class EditTicketLinkType extends EditRecord
{
    use HasSubNavigation;

    protected static string $resource = TicketLinkTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
