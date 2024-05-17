<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = auth()->user()->posts;
        return response()->json([
            'status' => 'success',
            'data' => $posts
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $user = auth()->user();

        $post = $user->posts()->create([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $post
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);

        if(!$post){
            return response()->json([
                'status' => 'error',
                'message' => 'post not found'
            ], 404);
        }

        $this->authorize('view', $post);

        return response()->json([
            'status' => 'success',
            'data' => $post
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);

        $this->authorize('update', $post);

        if(!$post){
            return response()->json([
                'status' => 'error',
                'message' => 'post not found'
            ], 404);
        }
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $post->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $post
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        
        $this->authorize('delete', $post);
        
        if(!$post){
            return response()->json([
                'status' => 'error',
                'message' => 'post not found'
            ], 404);
        }

        $post->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'post deleted'
        ], 200);
    }
}
