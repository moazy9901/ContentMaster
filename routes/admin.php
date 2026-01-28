<?php

use App\Http\Controllers\Admin\AddressController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\UsersController;

Route::middleware(['auth:web', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UsersController::class);

    Route::resource('students', StudentController::class);
    Route::resource('students.addresses', AddressController::class);
    Route::put('students/{student}/addresses/{address}/default', [AddressController::class, 'setDefaultAddress'])
         ->name('students.addresses.default');
    
    require __DIR__ . '/excel.php';
});