<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Sprints\Pages;

use App\Filament\App\Resources\Sprints\SprintResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSprints extends ListRecords
{
    protected static string $resource = SprintResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
