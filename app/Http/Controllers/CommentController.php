<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Controllers\OtherController;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    public function index(Request $request) {
        $comments = Comment::orderBy('id', 'DESC')->paginate(10);
        return view('comment.list', compact('comments'));
    }

    public function show($id) {
        $comment = Comment::find($id);
        return view('comment.show', compact('comment'));
    }

    public function destroy($id) {
        $comment = Comment::find($id);
        $comment->delete();
        return Redirect::route('comment-list')->with('message', 'Амжилттай устгагдлаа.');
    }
}