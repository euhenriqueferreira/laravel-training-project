<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\GuestMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index'])->middleware(GuestMiddleware::class)->name('login');
Route::post('/login', [LoginController::class, 'attemptLogin']);
