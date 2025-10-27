<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\Priority\Resources\TicketPriorities\Pages;

use App\Filament\Settings\Clusters\Priority\Resources\TicketPriorities\TicketPriorityResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Pages\Concerns\HasSubNavigation;
use Filament\Resources\Pages\EditRecord;

class EditTicketPriority extends EditRecord
{
    use HasSubNavigation;

    protected static string $resource = TicketPriorityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
