<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\TicketType\Resources\TicketTypes\Pages;

use App\Filament\Settings\Clusters\TicketType\Resources\TicketTypes\TicketTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Pages\Concerns\HasSubNavigation;
use Filament\Resources\Pages\EditRecord;

class EditTicketType extends EditRecord
{
    use HasSubNavigation;

    protected static string $resource = TicketTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
