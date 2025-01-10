<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RegisterController
{
    public function index(){
        return view('auth.register', [
            'emailAttempted' => session('emailAttempted') ? session('emailAttempted') : null,
        ]);
    }

    public function attemptRegister(RegisterRequest $request){
        $data = $request->validated();

        if(User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'remember_token' => Str::random(15),
        ])){
            if(Auth::attempt(
                ['email' => $data['email'], 'password' => $data['password']], 
                !empty($data['remember_me'])
            )){
                return to_route('dashboard');
            }

            return back()->with('errorMessage', 'Error on authentication');
        }
    }
}
