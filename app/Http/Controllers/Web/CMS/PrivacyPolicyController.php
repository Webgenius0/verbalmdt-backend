<?php

namespace App\Http\Controllers\Web\CMS;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    // ------------------------
    // LIST ALL PRIVACY POLICIES
    // ------------------------
    public function index()
    {
        $policies = PrivacyPolicy::orderBy('id', 'desc')->paginate(10);
        return view('backend.layouts.cms.privacy-policy.list', compact('policies'));
    }

    // ------------------------
    // SHOW CREATE FORM
    // ------------------------
    public function create()
    {
        return view('backend.layouts.cms.privacy-policy.add');
    }

    // ------------------------
    // STORE NEW POLICY
    // ------------------------
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|array',
            'description' => 'nullable|array',
        ]);

        PrivacyPolicy::create($request->all());

        return redirect()
            ->route('web-privacy-policies.index')
            ->with('success', 'Privacy Policy created successfully.');
    }

    // ------------------------
    // SHOW EDIT FORM
    // ------------------------
    public function edit($id)
    {
        $webPrivacyPolicy = PrivacyPolicy::findOrFail($id);

        return view('backend.layouts.cms.privacy-policy.edit', compact('webPrivacyPolicy'));
    }

    // ------------------------
    // UPDATE POLICY
    // ------------------------
    public function update(Request $request, $id)
    {
        $webPrivacyPolicy = PrivacyPolicy::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|array',
            'description' => 'nullable|array',
        ]);

        $webPrivacyPolicy->update([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('web-privacy-policies.index')
            ->with('success', 'Privacy Policy updated successfully.');
    }

    // ------------------------
    // DELETE POLICY
    // ------------------------
    public function destroy($id)
    {
        $webPrivacyPolicy = PrivacyPolicy::findOrFail($id);
        $webPrivacyPolicy->delete();

        return redirect()
            ->route('web-privacy-policies.index')
            ->with('success', 'Privacy Policy deleted successfully.');
    }
}
