<?php

namespace App\Http\Controllers\API\ElectricianDayApi;

use App\Http\Controllers\Controller;
use App\Models\ElectricianDayBanner;
use Illuminate\Http\Request;

class ElectricianDayBannerApiController extends Controller
{
    // GET all banners
    public function index()
    {
        $banners = ElectricianDayBanner::latest()->get()->map(function($banner) {
            return $this->formatBanner($banner);
        });

        return response()->json([
            'status' => 'success',
            'data' => $banners
        ]);
    }

    // GET single banner by ID
    public function show($id)
    {
        $banner = ElectricianDayBanner::find($id);

        if (!$banner) {
            return response()->json([
                'status' => 'error',
                'message' => 'Banner not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $this->formatBanner($banner)
        ]);
    }

    // Format banner for API
    private function formatBanner($banner)
    {
        return [
            'id' => $banner->id,
            'title' => $banner->title,
            'subtitle' => $banner->subtitle,
            'image' => $banner->image ? asset('storage/' . $banner->image) : null,
            'created_at' => $banner->created_at->toDateTimeString(),
            'updated_at' => $banner->updated_at->toDateTimeString(),
        ];
    }
}
