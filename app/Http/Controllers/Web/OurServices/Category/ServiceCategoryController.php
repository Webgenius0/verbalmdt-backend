<?php

namespace App\Http\Controllers\Web\OurServices\Category;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    // Show the list
    public function index()
    {
        $categories = ServiceCategory::all();
        return view('backend.layouts.ourServices.service_categories.list', compact('categories'));
    }
    // Show the create
    public function create()
    {
        return view('backend.layouts.ourServices.service_categories.add');
    }
    // Show the store form
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:service_categories,slug',
            'description' => 'nullable|string',
        ]);

        ServiceCategory::create($request->all());

        return redirect()->route('service-categories.index')->with('success', 'Category created successfully.');
    }
    // Show the edit form
    public function edit($id)
    {
        $category = ServiceCategory::findOrFail($id);
        return view('backend.layouts.ourServices.service_categories.edit', compact('category'));
    }

    // Update the category
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:service_categories,slug,' . $id,
            'description' => 'nullable|string',
        ]);

        $category = ServiceCategory::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
        ]);

        return redirect()->route('service-categories.index')
            ->with('success', 'Category updated successfully.');
    }
    // Destroy the category
    public function destroy($id)
    {
        $category = ServiceCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('service-categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
