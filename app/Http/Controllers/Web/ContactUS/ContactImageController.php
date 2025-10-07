<?php

namespace App\Http\Controllers\Web\ContactUS;

use App\Http\Controllers\Controller;
use App\Models\ContactImage;
use Illuminate\Http\Request;

class ContactImageController extends Controller
{
    // Show all contact images
    public function index()
    {
        $contactImages = ContactImage::latest()->paginate(12); // pagination
        return view('backend.layouts.contact-us.image-list', compact('contactImages'));
    }

    // Show create form
    public function create()
    {
        return view('backend.layouts.contact-us.image-create');
    }

    // Store new image in storage
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'title' => 'nullable|string|max:255',
            'status' => 'nullable|boolean',
        ]);


        $path = $request->file('image')->store('contact-images', 'public');

        ContactImage::create([
            'title' => $request->title,
            'image' => $path,
            'status' => $request->status ?? true,
        ]);

        return redirect()->route('web-contact-images.index')->with('success', 'Contact image uploaded successfully.');
    }

    // Delete image
    public function destroy($id)
    {
        $contactImage = ContactImage::findOrFail($id);


        if ($contactImage->image && file_exists(storage_path('app/public/'.$contactImage->image))) {
            unlink(storage_path('app/public/'.$contactImage->image));
        }

        $contactImage->delete();
        return redirect()->route('web-contact-images.index')->with('success', 'Contact image deleted successfully.');
    }
}
