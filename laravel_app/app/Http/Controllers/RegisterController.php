<?php

namespace App\Http\Controllers;

use App\Models\User;

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
        User::create($attributes);
        return redirect('/')->with('success', 'Your account has been created.');
    }
}
