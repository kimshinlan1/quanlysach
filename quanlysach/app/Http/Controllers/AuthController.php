<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //
    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            "email"=>"required|email",
            "password"=>"required"
        ]);

        if(Auth::attempt($credentials)){
            // Authentication was successful
            return redirect()->intended('/');
        }

        return redirect()->back()->withErrors([
            'email' => 'Sai thông tin đăng nhập'
        ]);
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
