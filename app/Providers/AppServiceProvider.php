<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // ✅ Correct
use Illuminate\Support\Facades\View; // ✅ Add this
use App\Models\SiteSetting;

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
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // Share site settings with all views
        View::composer('*', function ($view) {
            $settings = SiteSetting::first(); // assuming 1 row only
            $view->with('siteSettings', $settings);
        });
    }
}
