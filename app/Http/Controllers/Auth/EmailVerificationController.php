<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController
{
    public function verify(EmailVerificationRequest $request){
        $request->fulfill();
        
        return to_route('dashboard');
    }

    public function resend(Request $request){
        $request->user()->sendEmailVerificationNotification();
        
        return back()->with('successMessage', 'Verification link sent!');
    }
}
