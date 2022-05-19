<?php

namespace App\Http\Controllers;

use App\Models\Comment;

class CommentController extends Controller
{
    //
    public function postComment()
    {
        return view('/', [
            'comments' => Comment::all()
        ]);
    }
}
