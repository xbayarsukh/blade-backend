<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index($id) {
        $comments = Comment::join('users', 'users.id', 'comments.user_id')->where('comments.manga_id', $id)->select('comments.*', 'users.name as name')->get();
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => "",
            'data' => $comments,
        ]);
    }

    public function create(Request $request, $id) {
        $comment = new Comment;
        $comment->user_id = $request->user()->id;
        $comment->manga_id = $id;
        $comment->comment = $request->comment;
        $comment->save();
        
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => "Сэтгэгдэл нэмэгдлээ",
            'data' => $comment,
        ]);
    }

    public function delete(Request $request, $id) {
        $user_id = $request->user()->id;
        $comment = Comment::where('id', $id)->where('user_id', $user_id)->first();
        if ($comment) {
            $comment->delete();
        }
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => "Сэтгэгдэл устгагдлаа",
            'data' => [],
        ]);
    }
}