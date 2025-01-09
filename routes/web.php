<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Middleware\GuestMiddleware;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('welcome');
});

#region Authentication
Route::get('/login', [LoginController::class, 'index'])->middleware(GuestMiddleware::class)->name('login');
Route::post('/login', [LoginController::class, 'attemptLogin']);

Route::get('auth/{driver}/redirect', function($driver){
    return Socialite::driver($driver)->redirect();
})->name('social.redirect');

Route::get('auth/{driver}/callback', function($driver){
    $socialUser = Socialite::driver($driver)->user();

    $user = User::query()->where('email', '=', $socialUser->email)->firstOrCreate([
        'email' => $socialUser->email,
    ],[
        'name' => $socialUser->name,
        'password' =>Str::random(20)
    ]);

    Auth::login($user);

    return to_route('dashboard');
});

#endregion

#region Forgot Password
Route::get('/forgot-password', function(){
    return view('auth.forgot-password');
})->middleware(GuestMiddleware::class)->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::ResetLinkSent
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');
#endregion


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/logout', LogoutController::class)->name('logout');
