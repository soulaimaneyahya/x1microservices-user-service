<?php

namespace App\Http\Controllers\OAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OAuth\CreateClientService;

class OAuthClientController extends Controller
{
    public function __construct(
        private readonly CreateClientService $createClientService
    ) {
    }

    public function __invoke(Request $request, string $userId)
    {
        $rules = [
            'app_name' => 'required|string|max:255',
            'app_description' => 'nullable|string|max:500',
            'homepage_url' => 'required|url|max:255',
            'callback_url' => 'required|url|max:255',
        ];

        $this->validate($request, $rules);

        $validatedData = $request->only(array_keys($rules));

        $appName = $validatedData['app_name'];
        $appDescription = $validatedData['app_description'];

        $homepageUrl = $validatedData['homepage_url'];
        $callbackUrl = $validatedData['callback_url'];

        return $this->successResponse($this->createClientService->createClient(
            $userId,
            $appName,
            $homepageUrl,
            $callbackUrl,
            $appDescription,
        ));
    }
}
