<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Enums\ThemeMode;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use App\Filament\Pages\Auth\EditProfile;
use Filament\Navigation\NavigationGroup;
use Filament\Http\Middleware\Authenticate;
use App\Filament\User\Widgets\AssessmentScores;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class UserPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('user')
            ->path('/')
            ->login()
            ->passwordReset()
            ->profile(EditProfile::class)
            ->databaseNotifications()
            ->databaseNotificationsPolling('5s')
            ->colors([
                'primary' => Color::Emerald,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
                'danger' => Color::Red,
                'gray' => Color::Slate,
                'info' => Color::Blue,
            ])
            ->font('Inter')
            ->favicon(asset('images/favicon.ico'))
            ->userMenuItems([MenuItem::make()->label('Admin')->icon('heroicon-m-shield-check')->url('/admin')->visible(fn(): bool => auth()->user()->is_admin)])
            ->defaultThemeMode(ThemeMode::Dark)
            ->navigationGroups([NavigationGroup::make()->label('Settings')])
            ->discoverResources(in: app_path('Filament/User/Resources'), for: 'App\\Filament\\User\\Resources')
            ->discoverPages(in: app_path('Filament/User/Pages'), for: 'App\\Filament\\User\\Pages')
            ->pages([Pages\Dashboard::class])
            ->discoverWidgets(in: app_path('Filament/User/Widgets'), for: 'App\\Filament\\User\\Widgets')
            ->widgets([
            ])
            ->middleware([EncryptCookies::class, AddQueuedCookiesToResponse::class, StartSession::class, AuthenticateSession::class, ShareErrorsFromSession::class, VerifyCsrfToken::class, SubstituteBindings::class, DisableBladeIconComponents::class, DispatchServingFilamentEvent::class])
            ->authMiddleware([Authenticate::class])
            ->renderHook(
                'panels::simple-page.start',
                fn() => view('partials.login-logo')
            )
            ->renderHook(
                'panels::sidebar.footer',
                fn() => view('partials.sidebar-footer')
            );
    }
}
