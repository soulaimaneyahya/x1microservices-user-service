<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
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
     * Create one new user
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];

        $this->validate($request, $rules);

        $fields = $request->all();
        $fields['password'] = Hash::make($request->password);

        $user = User::create($fields);

        return $this->successResponse($user, Response::HTTP_CREATED);
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
     * Update an existing user
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        $rules = [
            'name' => 'max:255',
            'email' => 'email|unique:users,email,' . $user,
            'password' => 'min:8|confirmed',
        ];

        $this->validate($request, $rules);

        $user = User::findOrFail($user);

        $user->fill($request->all());

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($user->isClean()) {
            return $this->errorResponse(
                'At least one value must change',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $user->save();

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
