<?php

use App\Http\Controllers\Api\CustomerAuthController;
use App\Http\Controllers\Api\CustomerProfileController;
use App\Http\Controllers\Api\StudentAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('customer')->group(function () {
    Route::post('register', [CustomerAuthController::class, 'register']);
    Route::post('login', [CustomerAuthController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [CustomerAuthController::class, 'logout']);
        Route::get('profile', [CustomerProfileController::class, 'show']);
        Route::put('profile', [CustomerProfileController::class, 'update']);
        Route::post('profile/image', [CustomerProfileController::class, 'changeImage']);
    });
});

Route::prefix('student')->controller(StudentAuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');

    Route::get('me', 'me');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});
