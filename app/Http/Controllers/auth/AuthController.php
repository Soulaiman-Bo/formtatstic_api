<?php

namespace App\Http\Controllers\auth;

use App\Actions\Users\CreateUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(RegisterRequest $request, CreateUser $createUser): JsonResponse
    {
        $createUser(
            name: $request->input('name'),
            email: $request->input('email'),
            password: $request->input('password'),
        );

        return response()->json([
            'status' => 'user-created',
        ]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);

        $token = auth()->attempt($credentials);

        if (!$token) {
            return response()->json([
                'status' => 'invalid-credentials',
            ], 401);
        }

        return response()->json([
            'user'         => new UserResource(Auth::user()),
            'access_token' => $token,
        ]);
    }

    public function me()
    {
        return response()->json(new UserResource(auth()->user()));
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        $token = auth()->refresh();
        return response()->json(['token' =>  $token]);
    }
}
