<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\Status\Resources\TicketStatuses\Pages;

use App\Filament\Settings\Clusters\Status\Resources\TicketStatuses\TicketStatusResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Pages\Concerns\HasSubNavigation;
use Filament\Resources\Pages\EditRecord;

class EditTicketStatus extends EditRecord
{
    use HasSubNavigation;

    protected static string $resource = TicketStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
