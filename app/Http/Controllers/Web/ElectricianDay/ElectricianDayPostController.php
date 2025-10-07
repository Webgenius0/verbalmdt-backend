<?php

namespace App\Http\Controllers\Web\ElectricianDay;

use App\Http\Controllers\Controller;
use App\Models\ElectricianDayPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ElectricianDayPostController extends Controller
{
    // List all posts
    public function index()
    {
        $posts = ElectricianDayPost::latest()->get();
        return view('backend.layouts.cms.electricianDayPost.list', compact('posts'));
    }

    // Show create form
    public function create()
    {
        return view('backend.layouts.cms.electricianDayPost.add');
    }

    // Store new post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $path = $request->hasFile('image') ? $request->file('image')->store('simple_posts', 'public') : null;

        ElectricianDayPost::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path,
        ]);

        return redirect()->route('electricianDay-posts.index')->with('success', 'Post created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $post = ElectricianDayPost::findOrFail($id);
        return view('backend.layouts.cms.electricianDayPost.edit', compact('post'));
    }

    // Update post
    public function update(Request $request, $id)
    {
        $post = ElectricianDayPost::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
            $post->image = $request->file('image')->store('simple_posts', 'public');
        }

        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();

        return redirect()->route('electricianDay-posts.index')->with('success', 'Post updated successfully.');
    }

    // Delete post
    public function destroy($id)
    {
        $post = ElectricianDayPost::findOrFail($id);

        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('electricianDay-posts.index')->with('success', 'Post deleted successfully.');
    }
}
