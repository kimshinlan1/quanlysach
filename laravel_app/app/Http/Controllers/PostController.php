<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;

class PostController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $post = Post::latest()->filter(request(['search']))->get();
        return view('posts', [
            'posts' => $post,
            'categories' => $categories,
            'comments' => Comment::all()
        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            'post' => $post,
        ]);
    }
}
