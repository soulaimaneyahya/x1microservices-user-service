<?php

namespace App\Providers;

use App\Models\Client;
use Laravel\Passport\Passport;
use Illuminate\Support\ServiceProvider;

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

        /**
         * Define the scopes for the API
         */
        Passport::tokensCan([
            'books:read' => 'Read books',
            'books:create' => 'Create new books',
            'books:update' => 'Update existing books',
            'books:delete' => 'Delete books',
        
            'authors:read' => 'Read authors',
            'authors:create' => 'Create new authors',
            'authors:update' => 'Update existing authors',
            'authors:delete' => 'Delete authors',
        
            'users:read' => 'Read users',
        ]);

        /**
         * Set the default scopes for the API
         */
        Passport::setDefaultScope([
            'books:read',
            'authors:read',
        ]);
    }
}
