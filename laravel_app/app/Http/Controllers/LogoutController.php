<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function signOut(Request $request) {
        Auth::logout();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
