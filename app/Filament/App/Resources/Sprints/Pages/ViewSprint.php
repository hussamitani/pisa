<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Sprints\Pages;

use App\Filament\App\Resources\Sprints\SprintResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSprint extends ViewRecord
{
    protected static string $resource = SprintResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
