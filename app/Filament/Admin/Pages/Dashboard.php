<?php

declare(strict_types=1);

namespace App\Filament\Admin\Pages;

use App\Livewire\LinkWidget;
use Filament\Facades\Filament;
use Filament\Support\Icons\Heroicon;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected string $view = 'filament.admin.pages.dashboard';

    public function getWidgets(): array
    {
        return Filament::getWidgets();
    }

    public function getHeaderWidgets(): array
    {
        return [
            LinkWidget::to(
                route('filament.settings.pages.dashboard'),
                'Settings Panel',
                __('Configure your Pisa application'),
                __('Settings'),
                Heroicon::OutlinedCog,
            ),
            LinkWidget::to(
                '/app',
                'Pisa App',
                __('Configure your Pisa application'),
                __('Settings'),
                Heroicon::OutlinedCog,
            ),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return Filament::getWidgets();
    }
}
