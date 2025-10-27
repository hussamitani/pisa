<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\Status\Resources\TicketStatusSchemes\Pages;

use App\Filament\Settings\Clusters\Status\Resources\TicketStatusSchemes\TicketStatusSchemeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTicketStatusScheme extends EditRecord
{
    use \Filament\Pages\Concerns\HasSubNavigation;

    protected static string $resource = TicketStatusSchemeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
