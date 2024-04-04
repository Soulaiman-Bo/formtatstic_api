<?php

namespace App\Repositories;

use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;


class AuthRepository implements AuthRepositoryInterface
{
    public function register(array $data)
    {
        
        $user = User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => Hash::make($password),
        ]);
    }

    public function login(array $credentials)
    {
        // Implement login logic
    }
}
