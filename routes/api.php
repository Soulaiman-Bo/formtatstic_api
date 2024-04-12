<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\auth\ResetPasswordController;
use App\Http\Controllers\auth\SendPasswordResetLinkController;
use App\Http\Controllers\WorkspaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

Route::post('/register', [AuthController::class, "register"])->name("register");
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/forgotpassword', SendPasswordResetLinkController::class)->name('password.email');
Route::post('/resetpassword', ResetPasswordController::class)->name('password.reset');


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});

Route::get('/ping', function (Request  $request) {
    $connection = DB::connection('mongodb');

    $msg = 'MongoDB is accessible!';
    try {
        $connection->command(['ping' => 1]);
    } catch (\Exception  $e) {
        $msg = 'MongoDB is not accessible. Error: ' . $e->getMessage();
    }
    return ['msg' => $msg];
});

Route::middleware('auth:api')->group(function (){
    Route::apiResource('workspaces', WorkspaceController::class);
    // Route::apiResource('forms', FormController::class);
});




