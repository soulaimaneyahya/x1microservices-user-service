<?php

namespace App\Providers;

use App\Models\Client;
use Laravel\Passport\Passport;
use Illuminate\Support\ServiceProvider;
use Dusterio\LumenPassport\LumenPassport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // LumenPassport::routes($this->app->router);

        Passport::loadKeysFrom(storage_path('keys'));

        Passport::tokensExpireIn(\Carbon\Carbon::now()->addDays(7));
        Passport::refreshTokensExpireIn(\Carbon\Carbon::now()->addDays(30));

        Passport::useClientModel(Client::class);
    }
}
