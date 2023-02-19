<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
USE App\Http\Controllers\Api\v1\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




    Route::post('/auth/register', [AuthController::class, 'createUser']);
    Route::post('/auth/login', [AuthController::class, 'loginUser'])->name('login');
    // Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');


