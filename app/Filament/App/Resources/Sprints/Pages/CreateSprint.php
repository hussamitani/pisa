<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Sprints\Pages;

use App\Filament\App\Resources\Sprints\SprintResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSprint extends CreateRecord
{
    protected static string $resource = SprintResource::class;
}
