<?php

namespace App\Http\Controllers\API\Blogs;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogApiController extends Controller
{
    // GET /api-blogs → Get all blogs
    public function index()
    {
        $blogs = Blog::latest()->get();

        return response()->json([
            'success' => true,
            'data' => $blogs->map(fn($blog) => [
                'id' => $blog->id,
                'title' => $blog->title,
                'image_url' => $blog->image ? asset('storage/'.$blog->image) : null,
                'description' => $blog->description,
                'created_at' => $blog->created_at->format('Y-m-d H:i:s'),
            ])
        ]);
    }

    // GET /api-blogs/{id} → Get single blog
    public function show($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['success' => false, 'message' => 'Blog not found'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $blog->id,
                'title' => $blog->title,
                'image_url' => $blog->image ? asset('storage/'.$blog->image) : null,
                'description' => $blog->description,
                'created_at' => $blog->created_at->format('Y-m-d H:i:s'),
            ]
        ]);
    }
}
