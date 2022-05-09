<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function index()
    {       
        $categories = Category::all();
        $post = Post::latest()->filter(request(['search']))->get();
        return view('posts', [
            'posts' => $post,
            'categories' => $categories
        ]);
    }
}
