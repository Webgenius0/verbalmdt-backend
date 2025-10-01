<?php

namespace App\Http\Controllers\Web\CMS;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    // Display a listing of terms
    public function index()
    {
        $terms = Term::orderBy('id', 'desc')->paginate(10);
        return view('backend.layouts.cms.terms-conditions.list', compact('terms'));
    }

    // Show the form for creating a new term
    public function create()
    {
        return view('backend.layouts.cms.terms-conditions.add');
    }

    // Store a newly created term in storage
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|array',
            'sub_title.*' => 'required|string|max:255',
            'description' => 'required|array',
            'description.*' => 'nullable|string',
        ]);

        Term::create([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'description' => $request->description,
        ]);

        return redirect()->route('web-terms.index')
            ->with('success', 'Term & Condition created successfully.');
    }

    // Show the form for editing the specified term
    public function edit($id)
    {
        $web_term = Term::findOrFail($id);
        return view('backend.layouts.cms.terms-conditions.edit', compact('web_term'));
    }

    // Update the specified term in storage
    public function update(Request $request, $id)
    {
        $web_term = Term::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|array',
            'sub_title.*' => 'required|string|max:255',
            'description' => 'required|array',
            'description.*' => 'nullable|string',
        ]);

        $web_term->update([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'description' => $request->description,
        ]);

        return redirect()->route('web-terms.index')
            ->with('success', 'Term & Condition updated successfully.');
    }

    // Remove the specified term from storage
    public function destroy($id)
    {
        $web_term = Term::findOrFail($id);
        $web_term->delete();

        return redirect()->route('web-terms.index')
            ->with('success', 'Term & Condition deleted successfully.');
    }
}
