<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SendEmailVerificationEmail extends Controller
{
    public function __invoke(Request $request)
    {
        if($request->user()->hasVerifiedEmail()){
            return response()->json([
                'status' => 'email already verified'
            ]);
        }

        $request->user()->sendEmailVerificationNotification();
        
        return response()->json([
            'status' => 'verification link sent',
        ]);
    }
}
