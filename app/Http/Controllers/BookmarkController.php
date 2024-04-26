<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function store($recordId) {
        $user = \Auth::user();
        if (!$user->is_bookmark($recordId)) {
            $user->bookmark_records()->attach($recordId);
        }
        return back();
    }
    public function destroy($recordId) {
        $user = \Auth::user();
        if ($user->is_bookmark($recordId)) {
            $user->bookmark_records()->detach($recordId);
        }
        return back();
    }
}
