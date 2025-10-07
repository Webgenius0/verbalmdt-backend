<?php

namespace App\Http\Controllers\Web\ElectricianDay;

use App\Http\Controllers\Controller;
use App\Models\ElectricianDayVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ElectricianDayVideoController extends Controller
{
    // List all videos
    public function index()
    {
        $videos = ElectricianDayVideo::all();
        return view('backend.layouts.cms.electricianDayVideos.list', compact('videos'));
    }

    // Show create form
    public function create()
    {
        return view('backend.layouts.cms.electricianDayVideos.add');
    }

    // Store video
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'video' => 'required|mimetypes:video/mp4,video/avi,video/mov|max:51200',
        ]);

        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('electrician_day_videos', 'public');
        }

        ElectricianDayVideo::create($data);

        return redirect()->route('electrician-day-videos.index')->with('success', 'Video added successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $video = ElectricianDayVideo::findOrFail($id);
        return view('backend.layouts.cms.electricianDayVideos.edit', compact('video'));
    }

    // Update video
    public function update(Request $request, $id)
    {
        $video = ElectricianDayVideo::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'video' => 'nullable|mimetypes:video/mp4,video/avi,video/mov|max:51200',
        ]);

        if ($request->hasFile('video')) {
            // Delete old video
            if ($video->video && Storage::disk('public')->exists($video->video)) {
                Storage::disk('public')->delete($video->video);
            }
            $data['video'] = $request->file('video')->store('electrician_day_videos', 'public');
        } else {
            $data['video'] = $video->video; // keep old video
        }

        $video->update($data);

        return redirect()->route('electrician-day-videos.index')->with('success', 'Video updated successfully!');
    }

    // Delete video
    public function destroy($id)
    {
        $video = ElectricianDayVideo::findOrFail($id);

        if ($video->video && Storage::disk('public')->exists($video->video)) {
            Storage::disk('public')->delete($video->video);
        }

        $video->delete();

        return redirect()->route('electrician-day-videos.index')->with('success', 'Video deleted successfully!');
    }
}
