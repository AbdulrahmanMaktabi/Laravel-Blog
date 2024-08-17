<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validate = $request->validate([
            'name' => 'string',
            'email' => 'string|email',
            'subject' => 'string',
            'message' => 'string',
            'blog_id' => 'integer|exists:blogs,id'
        ]);

        // dd($validate);
        // Create a new comment using the validated data
        $comment = Comment::create($validate);

        return back()->with('comment_add', 'Your comment has been posted.');
    }
}
