<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return CommentResource::collection($comments);
    }

    public function show($id)
    {
        $comment = Comment::with('user', 'post')->findOrFail($id);
        $commentResource = new CommentResource($comment);

        return response()->json($commentResource, 200, [], JSON_PRETTY_PRINT);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = Comment::create([
            'content' => $request->input('content'),
            'user_id' => $request->input('user_id'),
            'post_id' => $request->input('post_id'),
        ]);

        return new CommentResource($comment);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update([
            'content' => $request->input('content'),
            'user_id' => $request->input('user_id'),
            'post_id' => $request->input('post_id'),
        ]);

        return new CommentResource($comment);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
