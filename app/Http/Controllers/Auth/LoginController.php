<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController
{
    // Call the login view
    public function index(){
        return view('auth.login');
    }

    // Attempt to login
    public function attemptLogin(LoginRequest $request){
        $data = $request->validated();

        if(Auth::attempt(
            ['email' => $data['email'], 'password' => $data['password']], 
            !empty($data['remember_me'])
        )){
            return to_route('dashboard');
        }

        session()->put('emailAttempted', $request->email);

        return back()->with('errorMessage', 'Invalid credentials! Wanna create an account with this email?');
    }


}
