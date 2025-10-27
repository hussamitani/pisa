<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\TicketType\Resources\TicketTypes;

use App\Filament\Settings\Clusters\TicketType\Resources\TicketTypes\Pages\CreateTicketType;
use App\Filament\Settings\Clusters\TicketType\Resources\TicketTypes\Pages\EditTicketType;
use App\Filament\Settings\Clusters\TicketType\Resources\TicketTypes\Pages\ListTicketTypes;
use App\Filament\Settings\Clusters\TicketType\Resources\TicketTypes\Schemas\TicketTypeForm;
use App\Filament\Settings\Clusters\TicketType\Resources\TicketTypes\Schemas\TicketTypeInfolist;
use App\Filament\Settings\Clusters\TicketType\Resources\TicketTypes\Tables\TicketTypesTable;
use App\Filament\Settings\Clusters\TicketType\TicketTypeCluster;
use App\Models\TicketType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TicketTypeResource extends Resource
{
    protected static ?string $model = TicketType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSwatch;

    protected static ?string $cluster = TicketTypeCluster::class;

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return TicketTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TicketTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TicketTypesTable::configure($table);
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
            'index' => ListTicketTypes::route('/'),
            'create' => CreateTicketType::route('/create'),
            'edit' => EditTicketType::route('/{record}/edit'),
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
