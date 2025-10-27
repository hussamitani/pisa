<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\Status\Resources\TicketStatusSchemes;

use App\Filament\Settings\Clusters\Status\Resources\TicketStatusSchemes\Pages\CreateTicketStatusScheme;
use App\Filament\Settings\Clusters\Status\Resources\TicketStatusSchemes\Pages\EditTicketStatusScheme;
use App\Filament\Settings\Clusters\Status\Resources\TicketStatusSchemes\Pages\ListTicketStatusSchemes;
use App\Filament\Settings\Clusters\Status\Resources\TicketStatusSchemes\RelationManagers\StatusesRelationManager;
use App\Filament\Settings\Clusters\Status\Resources\TicketStatusSchemes\Schemas\TicketStatusSchemeForm;
use App\Filament\Settings\Clusters\Status\Resources\TicketStatusSchemes\Schemas\TicketStatusSchemeInfolist;
use App\Filament\Settings\Clusters\Status\Resources\TicketStatusSchemes\Tables\TicketStatusSchemesTable;
use App\Filament\Settings\Clusters\Status\StatusCluster;
use App\Models\TicketStatusScheme;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TicketStatusSchemeResource extends Resource
{
    protected static ?string $model = TicketStatusScheme::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static ?string $cluster = StatusCluster::class;

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return TicketStatusSchemeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TicketStatusSchemeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TicketStatusSchemesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            StatusesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTicketStatusSchemes::route('/'),
            'create' => CreateTicketStatusScheme::route('/create'),
            'edit' => EditTicketStatusScheme::route('/{record}/edit'),
        ];
    }
}
