<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Comment $comment)
    {
        $input = $request['comment'];
        $input += ['user_id' => $request->user()->id];
        $comment->fill($input)->save();
        return redirect('/records/' . $comment->record_id);
    }
    
    public function update(CommentRequest $request, Comment $comment)
    {
        $input = $request['comment'];
        $input += ['user_id' => $request->user()->id];
        $comment->fill($input)->save();
        return redirect('/records/' . $comment->record_id);
    }
    
    public function delete(Comment $comment)
    {
        $comment->delete();
        return redirect('/records/' . $comment->record_id);
    }
}
