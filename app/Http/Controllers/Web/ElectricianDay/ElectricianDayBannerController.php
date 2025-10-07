<?php

namespace App\Http\Controllers\Web\ElectricianDay;

use App\Http\Controllers\Controller;
use App\Models\ElectricianDayBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ElectricianDayBannerController extends Controller
{
    public function index()
    {
        $banners = ElectricianDayBanner::latest()->get();
        return view('backend.layouts.cms.electricianDayBanner.list', compact('banners'));
    }

    public function create()
    {
        return view('backend.layouts.cms.electricianDayBanner.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $path = $request->hasFile('image') ? $request->file('image')->store('electrician_day_banners', 'public') : null;

        ElectricianDayBanner::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image' => $path,
        ]);

        return redirect()->route('electrician-day-banners.index')->with('success', 'Banner created successfully.');
    }

    public function edit($id)
    {
        $banner = ElectricianDayBanner::findOrFail($id);
        return view('backend.layouts.cms.electricianDayBanner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = ElectricianDayBanner::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }
            $banner->image = $request->file('image')->store('electrician_day_banners', 'public');
        }

        $banner->title = $request->title;
        $banner->subtitle = $request->subtitle;
        $banner->save();

        return redirect()->route('electrician-day-banners.index')->with('success', 'Banner updated successfully.');
    }

    public function destroy($id)
    {
        $banner = ElectricianDayBanner::findOrFail($id);

        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return redirect()->route('electrician-day-banners.index')->with('success', 'Banner deleted successfully.');
    }
}
