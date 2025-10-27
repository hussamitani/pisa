<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\Priority\Resources\TicketPriorities;

use App\Filament\Settings\Clusters\Priority\PriorityCluster;
use App\Filament\Settings\Clusters\Priority\Resources\TicketPriorities\Pages\CreateTicketPriority;
use App\Filament\Settings\Clusters\Priority\Resources\TicketPriorities\Pages\EditTicketPriority;
use App\Filament\Settings\Clusters\Priority\Resources\TicketPriorities\Pages\ListTicketPriorities;
use App\Filament\Settings\Clusters\Priority\Resources\TicketPriorities\Schemas\TicketPriorityForm;
use App\Filament\Settings\Clusters\Priority\Resources\TicketPriorities\Schemas\TicketPriorityInfolist;
use App\Filament\Settings\Clusters\Priority\Resources\TicketPriorities\Tables\TicketPrioritiesTable;
use App\Models\TicketPriority;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TicketPriorityResource extends Resource
{
    protected static ?string $model = TicketPriority::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSwatch;

    protected static ?string $cluster = PriorityCluster::class;

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return TicketPriorityForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TicketPriorityInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TicketPrioritiesTable::configure($table);
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
            'index' => ListTicketPriorities::route('/'),
            'create' => CreateTicketPriority::route('/create'),
            'edit' => EditTicketPriority::route('/{record}/edit'),
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
