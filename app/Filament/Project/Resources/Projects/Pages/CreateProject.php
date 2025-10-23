<?php

declare(strict_types=1);

namespace App\Filament\Project\Resources\Projects\Pages;

use App\Filament\Project\Resources\Projects\ProjectResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;
}
