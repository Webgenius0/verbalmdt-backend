<?php

namespace App\Http\Controllers\API\GlobalElectricianDayApi;

use App\Http\Controllers\Controller;
use App\Models\GlobalMultimedia;
use Illuminate\Http\Request;

class GlobalMultimediaApiController extends Controller
{
    // GET /api/global-multimedia
    public function index(Request $request)
    {
        $query = GlobalMultimedia::query();

        // Filter by year if provided
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        // Sorting logic (default: latest year first)
        $sortField = $request->query('sort_field', 'year'); // field to sort by
        $sortOrder = $request->query('sort_order', 'desc'); // asc or desc

        // Ensure only valid sort options
        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'desc';
        }

        $query->orderBy($sortField, $sortOrder);

        // Pagination
        $perPage = (int) $request->query('per_page', 10);
        $items = $query->paginate($perPage);

        // Format each record
        $items->getCollection()->transform(function ($item) {
            return $this->formatItem($item);
        });

        return response()->json([
            'status' => 'success',
            'data' => $items
        ]);
    }

    // GET /api/global-multimedia/{id}
    public function show($id)
    {
        $item = GlobalMultimedia::find($id);
        if (! $item) {
            return response()->json(['status' => 'error', 'message' => 'Item not found'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $this->formatItem($item)]);
    }
    // Helper - returns the item with full URLs for frontends
    private function formatItem(GlobalMultimedia $item): array
    {
        return [
            'id' => $item->id,
            'year' => $item->year,
            'images' => collect($item->images ?? [])->map(fn($p) => $p ? asset('storage/' . $p) : null)->values(),
            'videos' => collect($item->videos ?? [])->map(fn($p) => $p ? asset('storage/' . $p) : null)->values(),
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
            // optionally include raw paths if frontend needs them:
            'images_raw' => $item->images ?? [],
            'videos_raw' => $item->videos ?? [],
        ];
    }
}
