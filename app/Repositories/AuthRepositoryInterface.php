<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface AuthRepositoryInterface
{
    public function register(array $data);
    public function login(array $credentials);
    public function createToken(Request $request);
    public function deleteToken(Request $request);
    public function refresh(Request $request);

}

