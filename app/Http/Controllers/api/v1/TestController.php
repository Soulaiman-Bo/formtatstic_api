<?php

namespace App\Http\Controllers\api\v1;


use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function test(Request $request)
    {
        return response()->json([
            'message' => 'test tested successfully',
        ]);
    }
}
