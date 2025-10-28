<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\Tickets;

use App\Filament\App\Resources\Tickets\Pages\CreateTicket;
use App\Filament\App\Resources\Tickets\Pages\EditTicket;
use App\Filament\App\Resources\Tickets\Pages\ListTickets;
use App\Filament\App\Resources\Tickets\Pages\ViewTicket;
use App\Filament\App\Resources\Tickets\Schemas\TicketForm;
use App\Filament\App\Resources\Tickets\Schemas\TicketInfolist;
use App\Filament\App\Resources\Tickets\Tables\TicketsTable;
use App\Models\Ticket;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTicket;

    protected static ?int $navigationSort = 1;

    public static function getGlobalSearchResultTitle(Model $record): string|Htmlable
    {
        $icon = view('filament::components.icon', [
            'icon' => $record->type->icon,
            'class' => 'h-4 w-4 shrink-0',
        ])->render();

        $text = e($record->code).' '.e($record->title);

        return new HtmlString(
            '<div class="flex items-center gap-1.5">'.trim($icon).'<span>'.$text.'</span></div>'
        );
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'code', 'owner.name', 'type.name'];
    }

    public static function form(Schema $schema): Schema
    {
        return TicketForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TicketInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TicketsTable::configure($table);
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
            'index' => ListTickets::route('/'),
            'create' => CreateTicket::route('/create'),
            'view' => ViewTicket::route('/{record}'),
            'edit' => EditTicket::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return static::getModel()::query();
    }
}
