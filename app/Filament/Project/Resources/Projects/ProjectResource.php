<?php

declare(strict_types=1);

namespace App\Filament\Project\Resources\Projects;

use App\Filament\Project\Resources\Projects\Pages\CreateProject;
use App\Filament\Project\Resources\Projects\Pages\EditProject;
use App\Filament\Project\Resources\Projects\Pages\ListProjects;
use App\Filament\Project\Resources\Projects\Pages\ViewProject;
use App\Filament\Project\Resources\Projects\RelationManagers\TeamsRelationManager;
use App\Filament\Project\Resources\Projects\Schemas\ProjectForm;
use App\Filament\Project\Resources\Projects\Schemas\ProjectInfolist;
use App\Filament\Project\Resources\Projects\Tables\ProjectsTable;
use App\Models\Project;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedWallet;

    public static function form(Schema $schema): Schema
    {
        return ProjectForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProjectInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProjectsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            TeamsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProjects::route('/'),
            'create' => CreateProject::route('/create'),
            'view' => ViewProject::route('/{record}'),
            'edit' => EditProject::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
