<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Tenancy\Team\EditPage;
use App\Filament\Pages\Tenancy\Team\RegisterPage;
use App\Models\Team;
use Filament\FontProviders\GoogleFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function boot(): void
    {
        FilamentColor::register([
            'danger'  => Color::Red,
            'gray'    => Color::Zinc,
            'info'    => Color::Blue,
            'primary' => [
                50  => '239, 246, 255',
                100 => '219, 234, 254',
                200 => '191, 219, 254',
                300 => '147, 197, 253',
                400 => '96, 165, 250',
                500 => '59, 130, 246',
                600 => '#2B95F8',
                700 => '29, 78, 216',
                800 => '30, 64, 175',
                900 => '30, 58, 138',
                950 => '23, 37, 84',
            ],
            'success' => Color::Green,
            'warning' => Color::Amber,
        ]);
    }

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('/')
            ->sidebarCollapsibleOnDesktop()
            ->brandLogo(asset('/img/logo.svg'))
            ->brandLogoHeight('40px')
            ->favicon(asset('/img/icon.svg'))
            ->login()
            ->profile()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->font(
                'JetBrains Mono',
                provider: GoogleFontProvider::class,
            )
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
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->tenant(Team::class, slugAttribute: 'slug')
            ->tenantRegistration(RegisterPage::class)
            ->tenantProfile(EditPage::class);
    }
}
