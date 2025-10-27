<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\Priority\Resources\TicketPrioritySchemes;

use App\Filament\Settings\Clusters\Priority\PriorityCluster;
use App\Filament\Settings\Clusters\Priority\Resources\TicketPrioritySchemes\Pages\CreateTicketPriorityScheme;
use App\Filament\Settings\Clusters\Priority\Resources\TicketPrioritySchemes\Pages\EditTicketPriorityScheme;
use App\Filament\Settings\Clusters\Priority\Resources\TicketPrioritySchemes\Pages\ListTicketPrioritySchemes;
use App\Filament\Settings\Clusters\Priority\Resources\TicketPrioritySchemes\RelationManagers\PrioritiesRelationManager;
use App\Filament\Settings\Clusters\Priority\Resources\TicketPrioritySchemes\Schemas\TicketPrioritySchemeForm;
use App\Filament\Settings\Clusters\Priority\Resources\TicketPrioritySchemes\Schemas\TicketPrioritySchemeInfolist;
use App\Filament\Settings\Clusters\Priority\Resources\TicketPrioritySchemes\Tables\TicketPrioritySchemesTable;
use App\Models\TicketPriorityScheme;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TicketPrioritySchemeResource extends Resource
{
    protected static ?string $model = TicketPriorityScheme::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static ?string $cluster = PriorityCluster::class;

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return TicketPrioritySchemeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TicketPrioritySchemeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TicketPrioritySchemesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            PrioritiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTicketPrioritySchemes::route('/'),
            'create' => CreateTicketPriorityScheme::route('/create'),
            'edit' => EditTicketPriorityScheme::route('/{record}/edit'),
        ];
    }
}
