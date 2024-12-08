<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::all();

        return $this->successResponse($users);
    }

    public function show(string $userId): JsonResponse
    {
        $user = User::findOrFail($userId);

        return $this->successResponse($user);
    }
}
