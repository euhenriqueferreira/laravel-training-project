<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\GuestMiddleware;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SocialAuthenticationController;
use App\Http\Middleware\AuthMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(GuestMiddleware::class)->group(function (){

    #region Authentication
    // Route that calls the login view
    Route::get('/login', [LoginController::class, 'index'])->middleware(GuestMiddleware::class)->name('login');
    // Route to login with email and password
    Route::post('/login', [LoginController::class, 'attemptLogin']);

    // Route for redirect to OAuth2 provider
    Route::get('auth/{driver}/redirect', [SocialAuthenticationController::class, 'redirect'])->name('social.redirect');
    // Route for callback from OAuth2 provider
    Route::get('auth/{driver}/callback', [SocialAuthenticationController::class, 'attempLoginSocialUser']);
    #endregion

    #region Reset Password
    // Route that calls the view to enter the email to send the password reset link
    Route::get('/forgot-password', [ForgotPasswordController::class, 'view'])->name('password.request');
    // Route that sends the password reset link
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendPasswordResetLink'])->name('password.email');
    // Route that calls the view to enter the new password
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'view'])->name('password.reset');
    // Route that updates the password
    Route::post('/reset-password', [ResetPasswordController::class, 'updatePassword'])->name('password.update');
    #endregion
});

Route::middleware(AuthMiddleware::class)->group(function (){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/logout', LogoutController::class)->name('logout');
});

