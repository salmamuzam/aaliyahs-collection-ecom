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
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        /**
         * OUTSTANDING: Enforce strict data integrity and prevent N+1 issues
         */
        \Illuminate\Database\Eloquent\Model::shouldBeStrict(!$this->app->environment('production'));

        Gate::define('admin', function (User $user) {
            return $user->user_type === 'admin';
        });

        \Illuminate\Support\Facades\Event::listen(
            \App\Events\OrderPlaced::class,
            \App\Listeners\SendOrderConfirmationEmail::class,
        );

        \Illuminate\Support\Facades\Mail::extend('mailtrap', function (array $config = []) {
            return (new \Symfony\Component\Mailer\Bridge\Mailtrap\Transport\MailtrapTransportFactory)->create(
                \Symfony\Component\Mailer\Transport\Dsn::fromString("mailtrap://{$config['token']}@{$config['host']}")
            );
        });
    }
}
