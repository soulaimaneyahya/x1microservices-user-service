<?php

/**
 * Author: Soulaimane Yahya
 * Date: 2024-12-07
 */

namespace App\Traits;

use GuzzleHttp\Client;

trait RequestServices
{
    public function performRequest(
        string $method,
        string $requestUrl,
        array $formParams = [],
        array $headers = []
    ): array|null {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        if (isset($this->secret)) {
            $headers['Authorization'] = $this->secret;
        }

        $response = $client->request(
            $method,
            $requestUrl,
            [
                'form_params' => $formParams,
                'headers' => $headers
            ]
        );

        return json_decode($response->getBody()->getContents(), true);
    }
}
