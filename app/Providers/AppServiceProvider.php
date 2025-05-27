<?php

namespace App\Providers;

use App\Filament\Pages\ManageHomeSettings;
use App\Filament\Pages\ManageSocialSettings;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use TomatoPHP\FilamentSettingsHub\Facades\FilamentSettingsHub;
use TomatoPHP\FilamentSettingsHub\Services\Contracts\SettingHold;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::setUpdateRoute(function ($handle) {
            return Route::prefix(LaravelLocalization::setLocale())
                ->middleware('web') // Adjust middleware as needed
                ->post('/livewire/update', $handle);
        });
        $this->bootSettings();
//        FilamentSettingsHub::register([
//            SettingHold::make()
//                ->order(2)
//                ->label('Home Settings')
//                ->icon('heroicon-o-globe-alt')
//                ->route('filament.admin.pages.manage-home-settings')
//                ->page(ManageHomeSettings::class)
//                ->description('Manage homepage category settings')
//                ->group(''),
//
//
//        ]);
//        FilamentSettingsHub::register([
//            SettingHold::make()
//                ->order(1)
//                ->label('Social Settings')
//                ->icon('heroicon-o-globe-alt')
//                ->route('filament.admin.pages.manage-social-settings')
//                ->page(ManageSocialSettings::class)
//                ->description('Manage social media settings')
//                ->group(''),
//        ]);
    }
    public function bootSettings(): void
    {
        $settings = Cache::get(config('settings.cache_key'));
        if ($settings){
            $settings_formatted = Arr::dot($settings);

            foreach ($settings_formatted as $setting => $value){
                if ($value !== null){
                    Config::set($setting, $value);
                }
            }
        }

    }
}
