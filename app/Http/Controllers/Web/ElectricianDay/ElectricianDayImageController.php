<?php

namespace App\Http\Controllers\Web\ElectricianDay;

use App\Http\Controllers\Controller;
use App\Models\ElectricianDayImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ElectricianDayImageController extends Controller

{
    // Show list
    public function index()
    {
        $images  = ElectricianDayImage::latest()->get(); // or paginate()
        return view('backend.layouts.cms.electricianDayImage.list', compact('images'));
    }

    // Show create form
    public function create()
    {
        return view('backend.layouts.cms.electricianDayImage.add');
    }

    // Store new image
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('simple_images', 'public');
        }

        ElectricianDayImage::create([
            'image' => $path,
        ]);

        return redirect()->route('electricianDay-images.index')->with('success', 'Image uploaded successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $image = ElectricianDayImage::findOrFail($id);
        return view('backend.layouts.cms.electricianDayImage.edit', compact('image'));
    }

    // Update image (replace)
    public function update(Request $request, $id)
    {
        $item = ElectricianDayImage::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            // delete old file if exists
            if ($item->image && Storage::disk('public')->exists($item->image)) {
                Storage::disk('public')->delete($item->image);
            }

            $item->image = $request->file('image')->store('simple_images', 'public');
            $item->save();
        }

        return redirect()->route('electricianDay-images.index')->with('success', 'Image updated successfully.');
    }

    // Delete
    public function destroy($id)
    {
        $item = ElectricianDayImage::findOrFail($id);

        if ($item->image && Storage::disk('public')->exists($item->image)) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return redirect()->route('electricianDay-images.index')->with('success', 'Image deleted successfully.');
    }
}
