<?php

namespace App\Http\Controllers\API\ElectricianDayApi;

use App\Http\Controllers\Controller;
use App\Models\ElectricianDayImage;
use Illuminate\Http\Request;

class ElectricianDayImageApiController extends Controller
{
    /**
     * GET /api/electrician-day-images
     * - Query params:
     *   - per_page (optional): if provided >0 returns paginated response, otherwise returns all items
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 0);
        $query = ElectricianDayImage::latest();

        if ($perPage > 0) {
            $items = $query->paginate($perPage);
            // format each item in the paginator collection
            $items->getCollection()->transform(function ($item) {
                return $this->formatItem($item);
            });

            return response()->json([
                'status' => 'success',
                'data' => $items
            ]);
        }

        // return all
        $items = $query->get()->map(function ($item) {
            return $this->formatItem($item);
        });

        return response()->json([
            'status' => 'success',
            'data' => $items
        ]);
    }

    /**
     * GET /api/electrician-day-images/{id}
     */
    public function show($id)
    {
        $item = ElectricianDayImage::find($id);

        if (! $item) {
            return response()->json([
                'status' => 'error',
                'message' => 'Image not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $this->formatItem($item)
        ]);
    }

    /**
     * Format item for API consumers (adds full URL)
     */
    private function formatItem(ElectricianDayImage $item): array
    {
        return [
            'id'         => $item->id,
            'image'      => $item->image ? asset('storage/' . $item->image) : null,
            'created_at' => $item->created_at ? $item->created_at->toDateTimeString() : null,
            'updated_at' => $item->updated_at ? $item->updated_at->toDateTimeString() : null,
        ];
    }
}
