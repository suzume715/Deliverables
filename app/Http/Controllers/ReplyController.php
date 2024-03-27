<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Http\Requests\ReplyRequest;

class ReplyController extends Controller
{
    public function store(ReplyRequest $request, Reply $reply)
    {
        $input = $request['reply'];
        $input += ['user_id' => $request->user()->id];
        $reply->fill($input)->save();
        return redirect('/records/' . $reply->comment->record_id);
    }
    
    public function update(ReplyRequest $request, Reply $reply)
    {
        $input = $request['reply'];
        $input += ['user_id' => $request->user()->id];
        $reply->fill($input)->save();
        return redirect('/records/' . $reply->comment->record_id);
    }
    
    public function delete(Reply $reply)
    {
        $reply->delete();
        return redirect('/records/' . $reply->comment->record_id);
    }
}
