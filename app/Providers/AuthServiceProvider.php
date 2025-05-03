<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //translations models and policies
        \TomatoPHP\FilamentTranslations\Models\Translation::class => \App\Policies\TranslationPolicy::class,
        \TomatoPHP\FilamentBrowser\Models\Files::class => \App\Policies\BrowserPolicy::class,



        ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
