<?php


use Illuminate\Support\Facades\Route;


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



Route::prefix('/v1')->group(function () {
    require_once("api/v1/api.php");
    // Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');
});
