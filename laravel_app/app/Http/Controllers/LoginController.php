<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;
use View;

class LoginController extends Controller
{
    public function signInForm(Request $request) {
        return View('login.login');
    }

    public function signIn(Request $request) {
        $credentials = $request->validate([
            'username' => 'required | exists:users,username',
            'password' => 'required',
        ]);
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return Redirect('/')->with('success', 'Welcome to us');
        }
        return back()->withErrors([
            'username' => 'Your username or password cound be incorrect. Please try again.',
        ]);

        return Redirect('/');
    } 
}
