<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Sprints\Pages;

use App\Filament\App\Resources\Sprints\SprintResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSprint extends EditRecord
{
    protected static string $resource = SprintResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
