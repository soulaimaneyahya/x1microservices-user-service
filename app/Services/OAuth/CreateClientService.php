<?php

namespace App\Services\OAuth;

use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class CreateClientService
{
    /**
     * Create a new OAuth client for the user.
     *
     * @param string $userId
     * @param string $appName
     * @param string $redirectUrl
     * @return array
     */
    public function createClient(string $userId, string $appName, string $redirectUrl)
    {
        $plainSecret = Str::random(40);

        $client = Client::create([
            'user_id' => $userId,
            'name' => $appName,
            'secret' => $plainSecret,
            'redirect' => $redirectUrl,
            'personal_access_client' => false,
            'password_client' => false,
            'revoked' => false,
        ]);

        return [
            'client_id' => $client->id,
            'client_secret' => $plainSecret,
        ];
    }
}
