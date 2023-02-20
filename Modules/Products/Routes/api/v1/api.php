<?php

use Illuminate\Support\Facades\Route;
use Modules\Products\Http\Controllers\ProductsController;


Route::prefix('products')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [ProductsController::class, 'index'])->middleware('role:user|admin');
    Route::post('/', [ProductsController::class, 'store'])->middleware('role:admin');
    Route::get('/{id}', [ProductsController::class, 'show'])->middleware('role:user|admin');
    Route::post('/{id}/update', [ProductsController::class, 'update'])->middleware('role:admin');
    Route::delete('/{id}', [ProductsController::class, 'destroy'])->middleware('role:admin');
});
