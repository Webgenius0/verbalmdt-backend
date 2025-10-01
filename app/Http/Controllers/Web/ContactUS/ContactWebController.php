<?php

namespace App\Http\Controllers\Web\ContactUS;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactImage;
use Illuminate\Http\Request;

class ContactWebController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('id','desc')->paginate(10);


        $contactImages = ContactImage::orderBy('id','desc')->get();


        return view('backend.layouts.contact-us.list', compact('contacts', 'contactImages'));
    }
}
