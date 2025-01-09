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
        if(Auth::attempt($request->validated())){
            return to_route('/');
        }

        return back()->with('errorMessage', 'Invalid credentials');
    }
}
