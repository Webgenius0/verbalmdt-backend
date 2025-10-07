<?php

namespace App\Http\Controllers\Web\GlobalElectricianDay;

use App\Http\Controllers\Controller;
use App\Models\Timeline;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    // Show all timelines
    public function index()
    {
        $timelines = Timeline::latest()->paginate(10);
        return view('backend.layouts.cms.global-electrician-day-timeline.list', compact('timelines'));
    }

    // Show create form
    public function create()
    {
        return view('backend.layouts.cms.global-electrician-day-timeline.add');
    }

    // Store timeline
    public function store(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'name.*' => 'required|string|max:255',
            'description.*.*' => 'nullable|string',
        ]);

        // Save timeline
        Timeline::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'name' => $request->name,             // array of names
            'description' => $request->description, // array of arrays
        ]);

        // Redirect back with success
        return redirect()->route('timelines.index')
            ->with('success', 'Timeline created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $timeline = Timeline::findOrFail($id);
        return view('backend.layouts.cms.global-electrician-day-timeline.edit', compact('timeline'));
    }

    // Update timeline
    public function update(Request $request, $id)
    {
        $timeline = Timeline::findOrFail($id);
        $timeline->update($request->only(['title', 'subtitle', 'name', 'description']));
        return redirect()->route('timelines.index')->with('success', 'Timeline updated successfully');
    }

    // Delete timeline
    public function destroy($id)
    {
        $timeline = Timeline::findOrFail($id);
        $timeline->delete();
        return redirect()->route('timelines.index')->with('success', 'Timeline deleted successfully');
    }
}
