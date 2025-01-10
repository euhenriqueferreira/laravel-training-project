<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthenticationController
{
    public function redirect(string $driver){
        return Socialite::driver($driver)->redirect();
    }

    public function attempLoginSocialUser(string $driver){
        $socialUser = Socialite::driver($driver)->stateless()->user();

        $user = User::query()->where('email', '=', $socialUser->email)->firstOrCreate([
            'email' => $socialUser->email,
        ],[
            'name' => $socialUser->name,
            'password' =>Str::random(20)
        ]);
  
        Auth::login($user);

        return to_route('dashboard');
    }
}