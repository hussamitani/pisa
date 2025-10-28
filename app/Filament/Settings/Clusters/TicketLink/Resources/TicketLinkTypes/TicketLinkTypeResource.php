<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\TicketLink\Resources\TicketLinkTypes;

use App\Filament\Settings\Clusters\TicketLink\Resources\TicketLinkTypes\Pages\CreateTicketLinkType;
use App\Filament\Settings\Clusters\TicketLink\Resources\TicketLinkTypes\Pages\EditTicketLinkType;
use App\Filament\Settings\Clusters\TicketLink\Resources\TicketLinkTypes\Pages\ListTicketLinkTypes;
use App\Filament\Settings\Clusters\TicketLink\Resources\TicketLinkTypes\Schemas\TicketLinkTypeForm;
use App\Filament\Settings\Clusters\TicketLink\Resources\TicketLinkTypes\Schemas\TicketLinkTypeInfolist;
use App\Filament\Settings\Clusters\TicketLink\Resources\TicketLinkTypes\Tables\TicketLinkTypesTable;
use App\Filament\Settings\Clusters\TicketLink\TicketLinkCluster;
use App\Models\TicketLinkType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TicketLinkTypeResource extends Resource
{
    protected static ?string $model = TicketLinkType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedLink;

    protected static ?string $cluster = TicketLinkCluster::class;

    public static function form(Schema $schema): Schema
    {
        return TicketLinkTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TicketLinkTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TicketLinkTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTicketLinkTypes::route('/'),
            'create' => CreateTicketLinkType::route('/create'),
            'edit' => EditTicketLinkType::route('/{record}/edit'),
        ];
    }
}
