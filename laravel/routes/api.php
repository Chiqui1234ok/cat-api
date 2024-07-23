<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ImageController;

Route::view('/', 'api');

// User
Route::post('/user/register', [AuthController::class, 'register']);
Route::post('/user/login', [AuthController::class, 'login']);

/*
    * Secured routes
*/
Route::group([
    'middleware' => ['auth:sanctum']
], function()
{
    // User
    Route::post('/user/profile', [UserController::class, 'profile']);
    Route::post('/user/logout', [AuthController::class, 'logout']);
    // Cat
    Route::post('/cat', [CatController::class, 'store']);
    // Color
    Route::post('/color', [ColorController::class, 'store']);
    // Color
    Route::post('/image', [ImageController::class, 'store']);
});
