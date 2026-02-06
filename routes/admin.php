<?php

use App\Http\Controllers\Admin\AddressController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\UsersController;

Route::middleware(['auth:web', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UsersController::class);

    Route::resource('customers', CustomerController::class);
    Route::resource('customers.addresses', AddressController::class);
    Route::put('customers/{customer}/addresses/{address}/default', [AddressController::class, 'setDefaultAddress'])
        ->name('customers.addresses.default');

    require __DIR__ . '/excel.php';
});
