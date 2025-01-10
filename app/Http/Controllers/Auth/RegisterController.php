<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController
{
    public function index(){
        return view('auth.register', [
            'emailAttempted' => session('emailAttempted') ? session('emailAttempted') : null,
        ]);
    }

    public function attemptRegister(RegisterRequest $request){
        if(User::create($request->validated())){
            Auth::attempt($request->only('email', 'password'));

            return to_route('dashboard');
        }
    }
}
