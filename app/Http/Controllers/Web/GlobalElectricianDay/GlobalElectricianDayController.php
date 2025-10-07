<?php

namespace App\Http\Controllers\Web\GlobalElectricianDay;

use App\Http\Controllers\Controller;
use App\Models\GlobalElectricianDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GlobalElectricianDayController extends Controller
{
    public function index()
    {
        $days = GlobalElectricianDay::all();
        return view('backend.layouts.cms.global-electrician-day.list', compact('days'));

    }
    public function create()
    {
        return view('backend.layouts.cms.global-electrician-day.add');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',

            'story_name' => 'nullable|string|max:255',
            'story_image' => 'nullable|image',
            'story_description' => 'nullable|string',

            'mission_name' => 'nullable|string|max:255',
            'mission_image' => 'nullable|image',
            'mission_description' => 'nullable|string',

            'matters_name' => 'nullable|string|max:255',
            'matters_image' => 'nullable|image',
            'matters_description' => 'nullable|string',
        ]);

        // image upload
        if ($request->hasFile('story_image')) {
            $data['story_image'] = $request->file('story_image')->store('global_electrician_days', 'public');
        }
        if ($request->hasFile('mission_image')) {
            $data['mission_image'] = $request->file('mission_image')->store('global_electrician_days', 'public');
        }
        if ($request->hasFile('matters_image')) {
            $data['matters_image'] = $request->file('matters_image')->store('global_electrician_days', 'public');
        }

        GlobalElectricianDay::create($data);

        return redirect()->route('global-electrician-days.index')->with('success', 'Data added successfully!');
    }



    // Show the edit form
    public function edit($id)
    {
        $globalElectricianDay = GlobalElectricianDay::findOrFail($id);
        return view('backend.layouts.cms.global-electrician-day.edit', compact('globalElectricianDay'));
    }

    // Handle the update
    public function update(Request $request, $id)
    {
        $globalElectricianDay = GlobalElectricianDay::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',

            'story_name' => 'nullable|string|max:255',
            'story_image' => 'nullable|image',
            'story_description' => 'nullable|string',

            'mission_name' => 'nullable|string|max:255',
            'mission_image' => 'nullable|image',
            'mission_description' => 'nullable|string',

            'matters_name' => 'nullable|string|max:255',
            'matters_image' => 'nullable|image',
            'matters_description' => 'nullable|string',
        ]);

        // Handle images
        if ($request->hasFile('story_image')) {
            $data['story_image'] = $request->file('story_image')->store('global_electrician_days', 'public');
        } else {
            $data['story_image'] = $globalElectricianDay->story_image; // keep existing
        }

        if ($request->hasFile('mission_image')) {
            $data['mission_image'] = $request->file('mission_image')->store('global_electrician_days', 'public');
        } else {
            $data['mission_image'] = $globalElectricianDay->mission_image; // keep existing
        }

        if ($request->hasFile('matters_image')) {
            $data['matters_image'] = $request->file('matters_image')->store('global_electrician_days', 'public');
        } else {
            $data['matters_image'] = $globalElectricianDay->matters_image; // keep existing
        }

        $globalElectricianDay->update($data);

        return redirect()->route('global-electrician-days.index')->with('success', 'Data updated successfully!');
    }
    public function destroy($id)
    {
        $globalElectricianDay = GlobalElectricianDay::findOrFail($id);

        // Delete associated images from storage
        if ($globalElectricianDay->story_image && Storage::disk('public')->exists($globalElectricianDay->story_image)) {
            Storage::disk('public')->delete($globalElectricianDay->story_image);
        }

        if ($globalElectricianDay->mission_image && Storage::disk('public')->exists($globalElectricianDay->mission_image)) {
            Storage::disk('public')->delete($globalElectricianDay->mission_image);
        }

        if ($globalElectricianDay->matters_image && Storage::disk('public')->exists($globalElectricianDay->matters_image)) {
            Storage::disk('public')->delete($globalElectricianDay->matters_image);
        }

        // Delete the database record
        $globalElectricianDay->delete();

        return redirect()->route('global-electrician-days.index')->with('success', 'Data deleted successfully!');
    }
}
