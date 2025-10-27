<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\TicketType\Resources\TicketTypeSchemes;

use App\Filament\Settings\Clusters\TicketType\Resources\TicketTypeSchemes\Pages\CreateTicketTypeScheme;
use App\Filament\Settings\Clusters\TicketType\Resources\TicketTypeSchemes\Pages\EditTicketTypeScheme;
use App\Filament\Settings\Clusters\TicketType\Resources\TicketTypeSchemes\Pages\ListTicketTypeSchemes;
use App\Filament\Settings\Clusters\TicketType\Resources\TicketTypeSchemes\RelationManagers\TypesRelationManager;
use App\Filament\Settings\Clusters\TicketType\Resources\TicketTypeSchemes\Schemas\TicketTypeSchemeForm;
use App\Filament\Settings\Clusters\TicketType\Resources\TicketTypeSchemes\Schemas\TicketTypeSchemeInfolist;
use App\Filament\Settings\Clusters\TicketType\Resources\TicketTypeSchemes\Tables\TicketTypeSchemesTable;
use App\Filament\Settings\Clusters\TicketType\TicketTypeCluster;
use App\Models\TicketTypeScheme;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TicketTypeSchemeResource extends Resource
{
    protected static ?string $model = TicketTypeScheme::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static ?string $cluster = TicketTypeCluster::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return TicketTypeSchemeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TicketTypeSchemeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TicketTypeSchemesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            TypesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTicketTypeSchemes::route('/'),
            'create' => CreateTicketTypeScheme::route('/create'),
            'edit' => EditTicketTypeScheme::route('/{record}/edit'),
        ];
    }
}
