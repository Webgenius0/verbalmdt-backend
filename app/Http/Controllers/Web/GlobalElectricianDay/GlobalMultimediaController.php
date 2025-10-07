<?php

namespace App\Http\Controllers\Web\GlobalElectricianDay;

use App\Http\Controllers\Controller;
use App\Models\GlobalMultimedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GlobalMultimediaController extends Controller
{
    // Show create form
    public function index(Request $request)
    {
        $query = GlobalMultimedia::query();

        if ($request->has('year') && $request->year != '') {
            $query->where('year', $request->year);
        }

        $items = $query->orderBy('id', 'desc')->paginate(10); // paginate 10 per page
        return view('backend.layouts.cms.global-multimedia.list', compact('items'));
    }

    public function create()
    {
        return view('backend.layouts.cms.global-multimedia.add');
    }

    public function store(Request $request)
    {
        //  Validation
        $request->validate([
            'year' => 'required|integer',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120', // max 5MB per image
            'videos.*' => 'mimes:mp4,mov,avi,mkv|max:51200', // max 50MB per video
        ]);

        //  Handle images
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('global_multimedia/images', 'public');
                $images[] = $path;
            }
        }

        //  Handle videos
        $videos = [];
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $path = $video->store('global_multimedia/videos', 'public');
                $videos[] = $path;
            }
        }

        //  Save to database
        $item = GlobalMultimedia::create([
            'year' => $request->year,
            'images' => $images,
            'videos' => $videos,
        ]);

        //  Redirect back with success message
        return redirect()->route('global-multimedia.index')
            ->with('success', 'Global Multimedia added successfully!');
    }
    // Edit
    public function edit($id)
    {
        $item = GlobalMultimedia::findOrFail($id);
        return view('backend.layouts.cms.global-multimedia.edit', compact('item'));
    }
    // Update
    public function update(Request $request, $id)
    {
        $item = GlobalMultimedia::findOrFail($id);

        $request->validate([
            'year' => 'required|integer',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'videos.*' => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime|max:20000',
        ]);

        $item->year = $request->year;

        // Remove selected images
        if($request->has('remove_images')) {
            foreach($request->remove_images as $img) {
                if(Storage::exists($img)) {
                    Storage::delete($img);
                }
                $item->images = array_filter($item->images ?? [], fn($i) => $i !== $img);
            }
        }

        // Add new images
        if($request->hasFile('images')) {
            foreach($request->file('images') as $img) {
                $path = $img->store('global-multimedia/images','public');
                $item->images[] = $path;
            }
        }

        // Remove selected videos
        if($request->has('remove_videos')) {
            foreach($request->remove_videos as $vid) {
                if(Storage::exists($vid)) {
                    Storage::delete($vid);
                }
                $item->videos = array_filter($item->videos ?? [], fn($v) => $v !== $vid);
            }
        }

        // Add new videos
        if($request->hasFile('videos')) {
            foreach($request->file('videos') as $vid) {
                $path = $vid->store('global-multimedia/videos','public');
                $item->videos[] = $path;
            }
        }

        $item->save();

        return redirect()->route('global-multimedia.index')->with('success','Global Multimedia updated successfully.');
    }

// Destroy
    public function destroy($id)
    {
        $item = GlobalMultimedia::findOrFail($id);

        // Delete images from storage
        if($item->images) {
            foreach($item->images as $image) {
                if(Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        // Delete videos from storage
        if($item->videos) {
            foreach($item->videos as $video) {
                if(Storage::disk('public')->exists($video)) {
                    Storage::disk('public')->delete($video);
                }
            }
        }

        // Delete the record
        $item->delete();

        return redirect()->route('global-multimedia.index')->with('success', 'Global Multimedia deleted successfully.');
    }

}
