<?php

use Illuminate\Support\Facades\Route;
use Modules\Stores\Http\Controllers\StoresController;

Route::prefix('stores')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [StoresController::class, 'index'])->middleware('role:user|admin');
    Route::post('/', [StoresController::class, 'store'])->middleware('role:admin');
    Route::get('/{id}', [StoresController::class, 'show'])->middleware('role:user|admin');
    Route::post('/{id}/update', [StoresController::class, 'update'])->middleware('role:admin');
    Route::delete('/{id}', [StoresController::class, 'destroy'])->middleware('role:admin');
});
