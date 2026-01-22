<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UsersController;

Route::middleware(['auth', 'admin'])
->prefix('admin')
->name('admin.')
->group(function () {

Route::get('/dashboard', [DashboardController::class, 'index'])
->name('dashboard');

    // Users
    Route::resource('users', UsersController::class);
    
    require __DIR__ . '/excel.php';
});