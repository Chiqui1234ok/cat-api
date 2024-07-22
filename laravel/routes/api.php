<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CatController;

Route::view('/', 'api');

// Register
Route::post('/user/register', [AuthController::class, 'registerUser']);
// Login
Route::post('/user/login', [AuthController::class, 'loginUser']);

Route::group([
    'middleware' => ['auth:sanctum']
], function()
{
    Route::post('/user/profile', [UserController::class, 'profile']);
});
/*
    * Secured routes
*/
Route::middleware('auth:sanctum')->post('/cat', [CatController::class, 'store']);