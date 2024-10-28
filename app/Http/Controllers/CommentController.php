<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $data=$request->validated();
        Comment::create($data);
        return back()->with('status-comment','Your comment Sent Successfully');
    }
    
}