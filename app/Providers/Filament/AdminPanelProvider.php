<?php

namespace App\Providers\Filament;

use App\Filament\Admin\Themes\Awesome;
use App\Filament\Widgets\TotalImoveis;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Hasnayeen\Themes\Http\Middleware\SetTheme;
use Hasnayeen\Themes\Themes\Sunset;
use Hasnayeen\Themes\ThemesPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Emerald,
            ])
            ->colors([
                'primary' => Color::Cyan,
                'secondary' => Color::Green,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
                'gray' => Color::Gray,
                'danger' => Color::Rose,
                'info' => Color::Blue
            ])
            ->topNavigation()
            ->font('Poppins')
            ->favicon('https://www.svgrepo.com/show/282323/roof.svg')
            ->brandLogo('https://www.svgrepo.com/show/282323/roof.svg')
            ->brandName('Imobiliaria')
            ->brandLogoHeight(fn()=>auth()->check()?'3rem':'4rem')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->plugin(
                ThemesPlugin::make()
                    ->canViewThemesPage(fn () => auth()->check()))
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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
                    SetTheme::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
