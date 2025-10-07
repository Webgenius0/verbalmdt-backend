<?php

namespace App\Http\Controllers\API\ElectricianDayApi;

use App\Http\Controllers\Controller;
use App\Models\ElectricianDayVideo;
use Illuminate\Http\Request;

class ElectricianDayVideoApiController extends Controller
{
    /**
     * GET /api/electrician-day-videos
     * Optional query:
     *  - per_page (int) : if provided and >0 returns paginated result
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 0);
        $query = ElectricianDayVideo::latest();

        if ($perPage > 0) {
            $paginator = $query->paginate($perPage);
            $paginator->getCollection()->transform(function ($item) {
                return $this->formatVideo($item);
            });

            return response()->json([
                'status' => 'success',
                'data' => $paginator
            ]);
        }

        $items = $query->get()->map(function ($item) {
            return $this->formatVideo($item);
        });

        return response()->json([
            'status' => 'success',
            'data' => $items
        ]);
    }

    /**
     * GET /api/electrician-day-videos/{id}
     */
    public function show($id)
    {
        $video = ElectricianDayVideo::find($id);

        if (! $video) {
            return response()->json([
                'status' => 'error',
                'message' => 'Video not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $this->formatVideo($video)
        ]);
    }

    /**
     * Format single video item for API consumers
     */
    private function formatVideo(ElectricianDayVideo $v): array
    {
        return [
            'id' => $v->id,
            'title' => $v->title,
            'subtitle' => $v->subtitle,
            // full public URL for the stored video file (or null)
            'video' => $v->video ? asset('storage/' . $v->video) : null,
            // raw stored path (useful for updates/deletes)
            'video_raw' => $v->video,
            'created_at' => $v->created_at ? $v->created_at->toDateTimeString() : null,
            'updated_at' => $v->updated_at ? $v->updated_at->toDateTimeString() : null,
        ];
    }
}
