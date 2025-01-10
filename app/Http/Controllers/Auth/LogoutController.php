<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController
{
    public function __invoke()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        
        return to_route('login');
    }
}
