<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\TicketType\Resources\TicketTypeSchemes\Pages;

use App\Filament\Settings\Clusters\TicketType\Resources\TicketTypeSchemes\TicketTypeSchemeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditTicketTypeScheme extends EditRecord
{
    use \Filament\Pages\Concerns\HasSubNavigation;

    protected static string $resource = TicketTypeSchemeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
