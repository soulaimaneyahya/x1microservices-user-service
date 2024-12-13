<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\Client as PassportClient;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Client extends PassportClient
{
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'secret',
        'provider',
        'homepage_url',
        'callback_url',
        'personal_access_client',
        'password_client',
        'revoked',
    ];
}
