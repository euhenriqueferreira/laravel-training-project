<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\ForgotPasswordRequest;

class ForgotPasswordController
{
    public function view(){
        return view('auth.forgot-password');
    }

    public function sendPasswordResetLink(ForgotPasswordRequest $request){

        // Sends the password reset link
        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::ResetLinkSent
                    ? to_route('login')->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }
}
