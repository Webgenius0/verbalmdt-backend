<?php

namespace App\Http\Controllers\API\ElectricianDayApi;

use App\Http\Controllers\Controller;
use App\Models\ElectricianDayPost;
use Illuminate\Http\Request;

class ElectricianDayPostApiController extends Controller
{
    // GET all posts
    public function index()
    {
        $posts = ElectricianDayPost::latest()->get()->map(function ($post) {
            return $this->formatPost($post);
        });

        return response()->json([
            'status' => 'success',
            'data' => $posts
        ]);
    }

    // GET single post by ID
    public function show($id)
    {
        $post = ElectricianDayPost::find($id);

        if (!$post) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $this->formatPost($post)
        ]);
    }

    // Format post for API
    private function formatPost($post)
    {
        return [
            'id' => $post->id,
            'title' => $post->title,
            'description' => $post->description,
            'image' => $post->image ? asset('storage/' . $post->image) : null,
            'created_at' => $post->created_at->toDateTimeString(),
            'updated_at' => $post->updated_at->toDateTimeString(),
        ];
    }
}
