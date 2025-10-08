<?php

namespace App\Http\Controllers\API\GlobalElectricianSponsor;

use App\Http\Controllers\Controller;
use App\Models\GlobalElectricianSponsor;
use Illuminate\Http\Request;

class GlobalElectricianSponsorApiController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'company_name'=> 'nullable|string|max:255',
            'email'       => 'nullable|email|max:255',
            'phone'       => 'nullable|string|max:20',
            'country'     => 'nullable|string|max:100',
            'state'       => 'nullable|string|max:100',
            'city'        => 'nullable|string|max:100',
            'parish'      => 'nullable|string|max:255',
            'county'      => 'nullable|string|max:255',
            'zip_number'  => 'nullable|string|max:20',
            'message'     => 'nullable|string',
        ]);

        $sponsor = GlobalElectricianSponsor::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Sponsor created successfully.',
            'data'    => $sponsor,
        ], 201);
    }
}
