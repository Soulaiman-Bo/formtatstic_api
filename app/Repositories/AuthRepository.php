<?php

namespace App\Repositories;


use App\Models\User;


class AuthRepository implements AuthRepositoryInterface
{
    public function register(array $data)
    {

        if (User::where('email', $data['email'])->exists()) {
            return ['error' => 'User already exists.'];
        }

        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return $user;
    }

    public function login(array $credentials)
    {
        // Implement login logic
    }

    public function createToken($request)
    {
        $token = $request->user()->createToken('newTokenName')->plainTextToken;
        return $token;
    }

    public function deleteToken($request)
    {
        $request->user()->currentAccessToken()->delete();
    }

    public function refresh($request)
    {
        $this->deleteToken($request);
        $token = $this->createToken($request);
        return  $token;
    }
}
