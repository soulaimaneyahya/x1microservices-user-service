<?php

namespace App\Services\OAuth;

use App\Models\Client;
use Illuminate\Support\Str;

class CreateClientService
{
    /**
     * Create a new OAuth client for the user.
     *
     * @param string $userId
     * @param string $appName
     * @param string $homepageUrl
     * @param string $callbackUrl
     * @param ?string $appDescription
     * @return array
     */
    public function createClient(
        string $userId,
        string $appName,
        string $homepageUrl,
        string $callbackUrl,
        ?string $appDescription = null,
    ): array {
        $plainSecret = Str::random(40);

        $client = Client::create([
            'user_id' => $userId,
            'name' => $appName,
            'description' => $appDescription,
            'secret' => $plainSecret,
            'provider' => 'users',
            'homepage_url' => $homepageUrl,
            'callback_url' => $callbackUrl,
            'personal_access_client' => true,
            'password_client' => true,
            'revoked' => false,
        ]);

        return [
            'client_id' => $client->id,
            'client_secret' => $plainSecret,
        ];
    }
}
