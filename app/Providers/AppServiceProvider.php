<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use App\Models\User;

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
        // Force HTTPS in Production to prevent Man-in-the-Middle attacks
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Gate::define('admin', function (User $user) {
            return $user->user_type === 'admin';
        });
    }
}
