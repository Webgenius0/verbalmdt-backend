<?php

namespace App\Http\Controllers\API\GlobalElectricianDayApi;

use App\Http\Controllers\Controller;
use App\Models\GlobalElectricianDay;


class GlobalElectricianDayController extends Controller
{
    // GET all records
    public function index()
    {
        $records = GlobalElectricianDay::all()->map(function ($item) {
            return $this->formatRecord($item);
        });

        return response()->json([
            'status' => 'success',
            'data' => $records
        ]);
    }

    // GET single record by ID
    public function show($id)
    {
        $record = GlobalElectricianDay::find($id);

        if (!$record) {
            return response()->json([
                'status' => 'error',
                'message' => 'Record not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $this->formatRecord($record)
        ]);
    }
    // Add this method
    private function formatRecord($item)
    {
        return [
            'id' => $item->id,
            'title' => $item->title,
            'subtitle' => $item->subtitle,
            'story' => [
                'name' => $item->story_name,
                'image' => $item->story_image ? asset('storage/' . $item->story_image) : null,
                'description' => $item->story_description,
            ],
            'mission' => [
                'name' => $item->mission_name,
                'image' => $item->mission_image ? asset('storage/' . $item->mission_image) : null,
                'description' => $item->mission_description,
            ],
            'matters' => [
                'name' => $item->matters_name,
                'image' => $item->matters_image ? asset('storage/' . $item->matters_image) : null,
                'description' => $item->matters_description,
            ],
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
        ];
    }
}
