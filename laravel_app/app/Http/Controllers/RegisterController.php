<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return View('register.form');
    }

    public function store()
    {
        $attributes = request()->validate(
            [
                'name' => 'required|max:255|unique:users',
                'username' => 'required|max:255|unique:users',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:7|max:255',
            ]
        );
        $user = User::create($attributes);
        Auth::login($user);
        return redirect('/')->with('success', 'Your account has been created.');
    }
}
