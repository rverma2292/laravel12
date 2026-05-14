<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class BlogController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category', 'comments')->latest()->paginate(10);
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'string|nullable',
        ]);

        $post = Post::create(
            $validated
        );

        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $blog)
    {
        return response()->json($blog->load('category', 'comments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $blog)
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id|integer',
            'image' => 'string|nullable',
            'slug' => 'nullable|string',
        ]);
        $blog->update($validated);

        return response()->json($blog);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $blog)
    {
        if ($blog->delete()) {
            return response()->json(['message' => 'Deleted successfully'], 200);
        }

        return response()->json(['message' => 'Failed to delete'], 500);
    }

    public function getToken(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (!Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $request->user()->createToken($request->username)->plainTextToken;

        return response()->json(['token' => $token]);
    }
}
