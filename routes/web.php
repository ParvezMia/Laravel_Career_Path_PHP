<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::prefix('/')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login/store', [LoginController::class, 'login'])->name('login.store');
    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register/store', [RegisterController::class, 'store'])->name('register.store');
});

Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/',  [HomeController::class, 'index'])->name('home');
    Route::get('/search',  [HomeController::class, 'search'])->name('search');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [HomeController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/edit', [HomeController::class, 'update'])->name('profile.update');


    Route::prefix('/post')->group(function () {
        Route::post('/store', [PostController::class, 'store'])->name('post.store');
        Route::get('/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
        Route::put('/{id}/update', [PostController::class, 'update'])->name('post.update');
        Route::get('/{id}/show', [PostController::class, 'show'])->name('post.show');
        Route::delete('/{id}/delete', [PostController::class, 'delete'])->name('post.delete');
    });
});
