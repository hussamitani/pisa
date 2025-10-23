<?php

declare(strict_types=1);

namespace App\Filament\App\Pages;

use App\Models\Project;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\RegisterTenant;
use Filament\Schemas\Schema;

class CreateProject extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'New Project';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')
                    ->required(),
                TextInput::make('ticket_prefix')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }

    protected function handleRegistration(array $data): Project
    {
        $project = Project::create($data);

        // Add creator as project member
        $project->members()->attach(auth()->id(), ['role' => 'admin']);

        return $project;
    }
}
