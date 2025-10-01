<?php

namespace App\Http\Controllers\API\PrivacyPolicy;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        // Get all privacy policies
        $policies = PrivacyPolicy::orderBy('id', 'desc')->get();

        // Transform data if needed
        $data = $policies->map(function ($policy) {
            return [
                'id' => $policy->id,
                'title' => $policy->title,
                'sub_title' => $policy->sub_title,
                'description' => $policy->description,
                'created_at' => $policy->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $policy->updated_at->format('Y-m-d H:i:s'),
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
