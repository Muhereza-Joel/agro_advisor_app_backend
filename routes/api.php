<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DiseaseController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/roles', [AuthController::class, 'getRoles']);
    Route::post('/register', [UserController::class, 'store']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/diseases', [DiseaseController::class, 'index']);
    });
});
