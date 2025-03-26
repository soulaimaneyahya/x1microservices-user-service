<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Laravel\Passport\PassportServiceProvider as BasePassportServiceProvider;

class XPassportServiceProvider extends BasePassportServiceProvider
{
    public function boot()
    {
        // ensures Passport doesn’t load its default migrations while still calling the boot() logic.
        Passport::ignoreMigrations();

        parent::boot();
    }
}
