<?php

namespace App\Http\Controllers\API\ContactUs;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactImage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * List contacts (paginated)
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 10);
        $contacts = Contact::orderBy('id', 'desc')->paginate($perPage);


        return response()->json($contacts, 200);
    }


    /**
     * Store a new contact
     * (No separate FormRequest used — inline validation)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:contacts,email',
            'phone_number' => 'nullable|string|max:30',
            'message' => 'nullable|string',
            'terms' => 'required|boolean',
        ]);


        $contact = Contact::create($data);


        return response()->json([
            'message' => 'Contact created successfully.',
            'data' => $contact,
        ], 201);
    }


    /**
     * Show single contact
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return response()->json($contact, 200);
    }


    public function imagesGet()
    {
        $images = ContactImage::latest()->get();

        // Transform data
        $data = $images->map(function($img){
            return [
                'id' => $img->id,
                'image_url' => asset('storage/'.$img->image),
                'created_at' => $img->created_at->format('Y-m-d H:i:s'),
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Contact images retrieved successfully',
            'data' => $data,
        ]);
    }
}
