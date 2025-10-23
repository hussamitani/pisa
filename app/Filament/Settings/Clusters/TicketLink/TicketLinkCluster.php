<?php

declare(strict_types=1);

namespace App\Filament\Settings\Clusters\TicketLink;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Support\Icons\Heroicon;

class TicketLinkCluster extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedLink;

    protected static ?int $navigationSort = 4;

    protected static ?string $title = 'Link';
}
