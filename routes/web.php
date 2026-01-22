<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::resource('categories', CategoryController::class);
Route::resource('articles', ArticleController::class);
Route::post('/articles/validate-slug', [ArticleController::class, 'validateSlug'])->name('articles.validateSlug');
Route::post('/categories/validate-slug', [CategoryController::class, 'validateSlug'])->name('categories.validateSlug');

require __DIR__.'/auth.php';
require __DIR__.'/lang.php';
require __DIR__.'/admin.php';
require __DIR__.'/excel.php';
