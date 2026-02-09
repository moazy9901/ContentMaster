<?php

use App\Http\Controllers\Api\CustomerAddressController;
use App\Http\Controllers\Api\CustomerAuthController;
use App\Http\Controllers\Api\CustomerProfileController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('customer')->controller(CustomerAuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('refresh', 'refresh');
});

Route::middleware('auth:api')->prefix('customer/profile')->controller(CustomerProfileController::class)->group(function () {
    Route::get('/', 'me');
    Route::put('/update', 'update');
    Route::post('/image', 'updateImage');
    Route::post('logout', 'logout');
});

Route::prefix('customer')->middleware('auth:api')->group(function () {
    Route::get('addresses', [CustomerAddressController::class, 'index']);
    Route::post('addresses', [CustomerAddressController::class, 'store']);
    Route::put('addresses/{address}', [CustomerAddressController::class, 'update']);
    Route::patch('addresses/{address}/default', [CustomerAddressController::class, 'setDefault']);
    Route::delete('addresses/{address}', [CustomerAddressController::class, 'destroy']);
    });
    
Route::get('products/import', [ProductController::class, 'import']);
