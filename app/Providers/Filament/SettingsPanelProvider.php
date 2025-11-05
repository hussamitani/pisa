<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class SettingsPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('settings')
            ->path('settings')
            ->topNavigation()
            ->maxContentWidth(Width::Full)
            ->viteTheme('resources/css/filament/settings/theme.css')
            ->colors([
                'primary' => Color::Lime,
            ])
            ->discoverResources(in: app_path('Filament/Settings/Resources'), for: 'App\Filament\Settings\Resources')
            ->discoverPages(in: app_path('Filament/Settings/Pages'), for: 'App\Filament\Settings\Pages')
            ->discoverWidgets(in: app_path('Filament/Settings/Widgets'), for: 'App\Filament\Settings\Widgets')
            ->discoverClusters(in: app_path('Filament/Settings/Clusters'), for: 'App\Filament\Settings\Clusters')
            ->pages([
                Dashboard::class,
            ])
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->navigationItems([
                NavigationItem::make(__('Projects'))
                    ->icon(Heroicon::Square3Stack3d)
                    ->url('/projects'),
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->resourceEditPageRedirect('index')
            ->resourceCreatePageRedirect('index');
    }
}
