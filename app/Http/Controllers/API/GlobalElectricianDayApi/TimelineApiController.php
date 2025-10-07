<?php

namespace App\Http\Controllers\API\GlobalElectricianDayApi;

use App\Http\Controllers\Controller;
use App\Models\Timeline;
use Illuminate\Http\Request;

class TimelineApiController extends Controller
{
    // Get all timelines
    public function index()
    {
        $timelines = Timeline::latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $timelines
        ]);
    }

    // Get single timeline by ID
    public function show($id)
    {
        $timeline = Timeline::find($id);

        if (!$timeline) {
            return response()->json([
                'status' => 'error',
                'message' => 'Timeline not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $timeline
        ]);
    }
}
