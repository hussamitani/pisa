<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\Status\Resources\TicketStatuses;

use App\Filament\Settings\Clusters\Status\Resources\TicketStatuses\Pages\CreateTicketStatus;
use App\Filament\Settings\Clusters\Status\Resources\TicketStatuses\Pages\EditTicketStatus;
use App\Filament\Settings\Clusters\Status\Resources\TicketStatuses\Pages\ListTicketStatuses;
use App\Filament\Settings\Clusters\Status\Resources\TicketStatuses\Schemas\TicketStatusForm;
use App\Filament\Settings\Clusters\Status\Resources\TicketStatuses\Schemas\TicketStatusInfolist;
use App\Filament\Settings\Clusters\Status\Resources\TicketStatuses\Tables\TicketStatusesTable;
use App\Filament\Settings\Clusters\Status\StatusCluster;
use App\Models\TicketStatus;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TicketStatusResource extends Resource
{
    protected static ?string $model = TicketStatus::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSwatch;

    protected static ?string $cluster = StatusCluster::class;

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return TicketStatusForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TicketStatusInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TicketStatusesTable::configure($table);
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
            'index' => ListTicketStatuses::route('/'),
            'create' => CreateTicketStatus::route('/create'),
            'edit' => EditTicketStatus::route('/{record}/edit'),
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
