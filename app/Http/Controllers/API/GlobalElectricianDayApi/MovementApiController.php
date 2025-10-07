<?php

namespace App\Http\Controllers\API\GlobalElectricianDayApi;

use App\Http\Controllers\Controller;
use App\Models\Movement;
use Illuminate\Http\Request;

class MovementApiController extends Controller
{
    // GET /api/movements
    public function index()
    {
        $movements = Movement::latest()->get()->map(fn($m) => $this->format($m));

        return response()->json([
            'status' => 'success',
            'data' => $movements,
        ]);
    }

    // GET /api/movements/{id}
    public function show($id)
    {
        $movement = Movement::find($id);
        if (!$movement) {
            return response()->json(['status' => 'error', 'message' => 'Movement not found'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $this->format($movement)]);
    }

    // Helper to format the response (include full image URL)
    private function format(Movement $m): array
    {
        return [
            'id' => $m->id,
            'image' => $m->image ? asset('storage/' . $m->image) : null,
            'title' => $m->title,
            'description' => $m->description,
            'created_at' => $m->created_at,
            'updated_at' => $m->updated_at,
        ];
    }
}
