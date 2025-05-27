<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Settings\Settings;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Outerweb\FilamentSettings\Filament\Plugins\FilamentSettingsPlugin;

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
                'primary' => Color::Blue ,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
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
            ->authMiddleware([Authenticate::class,])
            ->plugins([\BezhanSalleh\FilamentShield\FilamentShieldPlugin::make()])
            ->plugin(\TomatoPHP\FilamentUsers\FilamentUsersPlugin::make())
            ->plugin(\TomatoPHP\FilamentLanguageSwitcher\FilamentLanguageSwitcherPlugin::make())
            ->plugin(\TomatoPHP\FilamentTranslations\FilamentTranslationsPlugin::make())
            ->plugin(
                SpatieLaravelTranslatablePlugin::make()
                    ->defaultLocales(['en', 'ar']),
            )
            ->plugin(
                \TomatoPHP\FilamentBrowser\FilamentBrowserPlugin::make()
                    ->hiddenFolders([
                        base_path('app')
                    ])
                    ->hiddenFiles([
                        base_path('.env')
                    ])
                    ->allowCreateFolder()
                    ->allowEditFile()
                    ->allowCreateNewFile()
                    ->allowCreateFolder()
                    ->allowRenameFile()
                    ->allowDeleteFile()
                    ->allowMarkdown()
                    ->allowCode()
                    ->allowPreview()
                    ->basePath(base_path())
            )
//            ->plugin(
//                \TomatoPHP\FilamentSettingsHub\FilamentSettingsHubPlugin::make()
//                    ->allowShield()
//                    ->allowLocationSettings()
//                    ->allowSiteSettings()
//            )
            ->plugins([
                FilamentSettingsPlugin::make()
                    ->pages([
                        Settings::class,
                    ])


            ])
            ->navigationGroups([
                'News',
                'General',
                'Users',
                'Settings',
            ]);
    }
}
