<?php

namespace App\Http\Controllers\API\HostEnrollmentApi;

use App\Http\Controllers\Controller;
use App\Models\HostEnrollment;
use Illuminate\Http\Request;

class HostEnrollmentApiController extends Controller
{
    // GET all enrollments
    public function index()
    {
        $enrollments = HostEnrollment::all();

        return response()->json([
            'status' => true,
            'message' => 'Host Enrollments fetched successfully',
            'data' => $enrollments
        ], 200);
    }

    // POST a new enrollment
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'annual_income' => 'nullable|string',
            'employee_number' => 'nullable|string',
            'country' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip_number' => 'nullable|string|max:20',
            'parish' => 'nullable|string|max:100',
            'county' => 'nullable|string|max:100',
            'licence_number' => 'nullable|string',
            'licence_agency_url' => 'nullable|url',
            'message' => 'nullable|string',
            'answers_json' => 'nullable|array',
        ]);

        $enrollment = HostEnrollment::create([
            'name' => $request->name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'annual_income' => $request->annual_income,
            'employee_number' => $request->employee_number,
            'country' => $request->country,
            'city' => $request->city,
            'state' => $request->state,
            'zip_number' => $request->zip_number,
            'parish' => $request->parish,
            'county' => $request->county,
            'licence_number' => $request->licence_number,
            'licence_agency_url' => $request->licence_agency_url,
            'message' => $request->message,
            'answers_json' => $request->answers_json,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Host Enrollment created successfully',
            'data' => $enrollment
        ], 201);
    }
}
