<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\HomeApiController;
use App\Http\Controllers\API\PostApiController;
use App\Http\Controllers\API\Auth\LoginApiController;
use App\Http\Controllers\API\Auth\RegisterApiController;


Route::post('/login', [LoginApiController::class, 'login'])->name('auth.login');
Route::post('/register', [RegisterApiController::class, 'register'])->name('auth.register');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/home', [HomeApiController::class, 'index'])->name('home.index');
    Route::get('/search', [HomeApiController::class, 'search'])->name('home.search');

    Route::prefix('profile')->group(function () {
        Route::get('/', [HomeApiController::class, 'profile'])->name('profile.show');
        Route::get('/edit', [HomeApiController::class, 'edit'])->name('profile.edit');
        Route::put('/edit', [HomeApiController::class, 'update'])->name('profile.update');
    });

    Route::prefix('posts')->group(function () {
        Route::post('/', [PostApiController::class, 'store'])->name('posts.store');
        Route::get('/{id}/edit', [PostApiController::class, 'edit'])->name('posts.edit');
        Route::put('/{id}', [PostApiController::class, 'update'])->name('posts.update');
        Route::get('/{id}', [PostApiController::class, 'show'])->name('posts.show');
        Route::delete('/{id}', [PostApiController::class, 'destroy'])->name('posts.destroy');
    });
});
