<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;


Route::prefix('/')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login/store', [LoginController::class, 'login'])->name('login.store');
    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register/store', [RegisterController::class, 'store'])->name('register.store');
});