<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return PostResource::collection($posts);
    }

    public function show($id)
    {
        $post = Post::with('user', 'category', 'comments')->findOrFail($id);
        $postResource = new PostResource($post);

        return response()->json($postResource, 200, [], JSON_PRETTY_PRINT);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
            'published_at' => 'nullable|date',
        ]);

        $post = Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => $request->input('user_id'),
            'category_id' => $request->input('category_id'),
            'published_at' => $request->input('published_at'),
        ]);

        return new PostResource($post);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
            'published_at' => 'nullable|date',
        ]);

        $post = Post::findOrFail($id);
        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => $request->input('user_id'),
            'category_id' => $request->input('category_id'),
            'published_at' => $request->input('published_at'),
        ]);

        return new PostResource($post);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
}
