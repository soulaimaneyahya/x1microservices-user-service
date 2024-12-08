<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends Controller
{
    /**
     * List users
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::all();

        return $this->successResponse($users);
    }

    /**
     * Show user
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function show(string $userId): JsonResponse
    {
        $user = User::findOrFail($userId);

        return $this->successResponse($user);
    }

    /**
     * Get auth user
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function auth(Request $request): JsonResponse
    {
        return $this->successResponse($request->user());
    }
}
