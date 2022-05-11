<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function list(Category $category)
    {
        return view('posts', [
            'posts' => $category->posts,
            'currentCaterory' => $category,
            'categories' => Category::all()
        ]);
    }
}
