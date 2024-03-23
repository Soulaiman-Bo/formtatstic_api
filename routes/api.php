<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\auth\ResetPasswordController;
use App\Http\Controllers\auth\SendEmailVerificationEmail;
use App\Http\Controllers\auth\SendPasswordResetLinkController;
use App\Http\Controllers\auth\VerifyEmailController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\WorkspaceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::group([
//     'middleware' => 'api',
//     'prefix' => 'auth'

// ], function($router){

// });


Route::post('/register', [AuthController::class, "register"])->name("register");
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/forgotpassword', SendPasswordResetLinkController::class)->name('password.email');
Route::post('/resetpassword', ResetPasswordController::class)->name('password.reset');

Route::group(['middleware' => 'api',], function ($router) {
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/me', [AuthController::class, 'me']);
    Route::post('/me', [AuthController::class, 'me']);
});

Route::middleware('auth:api')->group(function (){
    Route::post('/verifyemail', SendEmailVerificationEmail::class)->name('verification.email');
    Route::get('/verification', VerifyEmailController::class)->name('verification.verify');

});


// workspaces routes 
Route::middleware('auth:api')->group(function (){
    Route::apiResource('workspaces', WorkspaceController::class);
    Route::apiResource('forms', FormController::class);

});




