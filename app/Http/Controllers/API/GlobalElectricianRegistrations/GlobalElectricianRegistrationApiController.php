<?php

namespace App\Http\Controllers\API\GlobalElectricianRegistrations;

use App\Http\Controllers\Controller;
use App\Models\GlobalElectricianRegistration;
use App\Models\GlobalElectricianSponsor;
use Illuminate\Http\Request;

class GlobalElectricianRegistrationApiController extends Controller
{
    /**
     * Store a new registration
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                 => 'required|string|max:255',
            'email'                => 'nullable|email|max:255',
            'phone'                => 'nullable|string|max:20',
            'country'              => 'nullable|string|max:100',
            'state'                => 'nullable|string|max:100',
            'city'                 => 'nullable|string|max:100',
            'parish'               => 'nullable|string|max:255',
            'county'               => 'nullable|string|max:255',
            'zip_number'           => 'nullable|string|max:20',
            'message'              => 'nullable|string',
            'licence_number'       => 'nullable|string|max:100',
            'licence_agency_url'   => 'nullable|url|max:255',
        ]);

        $registration = GlobalElectricianRegistration::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Registration created successfully.',
            'data'    => $registration,
        ], 201);
    }
}
