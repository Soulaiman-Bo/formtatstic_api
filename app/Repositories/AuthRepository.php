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

        // Continue with user creation if not exists
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return $user;
    }

    public function login(array $credentials)
    {
        // Implement login logic
    }
}
