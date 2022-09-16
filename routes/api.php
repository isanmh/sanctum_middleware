<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// register && login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/products', [ProductAPIController::class, 'index'])->middleware(['auth:sanctum', 'isAuth']);
// middlaware dengan sanctum
Route::middleware(['auth:sanctum', 'isAuth'])->group(function () {
    // Resfull api Products
    Route::post('/products', [ProductAPIController::class, 'store']);
    Route::get('/products/{id}', [ProductAPIController::class, 'show']);
    Route::put('/products/{id}', [ProductAPIController::class, 'update']);
    Route::delete('/products/{id}', [ProductAPIController::class, 'destroy']);
    // logout
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
});
