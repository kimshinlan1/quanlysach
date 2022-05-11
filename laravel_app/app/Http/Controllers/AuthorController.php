<?php

namespace App\Http\Controllers;

class AuthorController extends Controller
{
    public function show(User $user)
    {
        return view('posts', [
            'posts' => $user->posts,
            'categories' => Category::all()
        ]);
    }
}
