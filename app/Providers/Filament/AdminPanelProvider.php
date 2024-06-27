<?php

namespace App\Providers\Filament;

use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
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
    // Method to define the panel configuration
    public function panel(Panel $panel): Panel
    {
        return $panel
            // Set the default panel configuration
            ->default()
            // Set the panel ID to 'admin'
            ->id('admin')
            // Define the base path for the admin panel
            ->path('admin')
            // Configure login settings for the admin panel
            ->login()
            // Set primary color to orange for the admin panel
            ->colors([
                'primary' => Color::Orange,
            ])
            // Discover resources in the specified path
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            // Discover pages in the specified path
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            // Register specific pages for the admin panel
            ->pages([
                Pages\Dashboard::class,
            ])
            // Discover widgets in the specified path
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            // Register specific widgets for the admin panel
            ->widgets([
                OrderStats::class,
                // Widgets\AccountWidget::class, // Uncomment if needed
                // Widgets\FilamentInfoWidget::class, // Uncomment if needed
            ])
            // Register middleware for the admin panel
            ->middleware([
                // Middleware to encrypt cookies
                EncryptCookies::class,
                // Middleware to add queued cookies to the response
                AddQueuedCookiesToResponse::class,
                // Middleware to start the session
                StartSession::class,
                // Middleware to authenticate the session
                AuthenticateSession::class,
                // Middleware to share errors from the session
                ShareErrorsFromSession::class,
                // Middleware to verify CSRF token
                VerifyCsrfToken::class,
                // Middleware to substitute route bindings
                SubstituteBindings::class,
                // Middleware to disable Blade icon components
                DisableBladeIconComponents::class,
                // Middleware to dispatch the Filament serving event
                DispatchServingFilamentEvent::class,
            ])
            // Register authentication middleware for the admin panel
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
