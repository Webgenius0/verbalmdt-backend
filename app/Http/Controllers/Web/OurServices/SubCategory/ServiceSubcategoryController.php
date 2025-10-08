<?php

namespace App\Http\Controllers\Web\OurServices\SubCategory;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use App\Models\ServiceSubcategory;
use Illuminate\Http\Request;

class ServiceSubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = ServiceSubcategory::with('category')->paginate(10);
        return view('backend.layouts.ourServices.service_subCategory.list', compact('subcategories'));
    }

    public function create()
    {
        $categories = ServiceCategory::all();
        return view('backend.layouts.ourServices.service_subCategory.add', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:service_categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:service_subcategories,slug',
            'description' => 'nullable|string',
        ]);

        ServiceSubcategory::create($request->all());

        return redirect()->route('service-subcategories.index')
            ->with('success', 'Subcategory created successfully.');
    }
    // Show edit form
    public function edit($id)
    {
        $serviceSubcategory = ServiceSubcategory::findOrFail($id);

        $categories = ServiceCategory::all();
        return view('backend.layouts.ourServices.service_subCategory.edit', compact('serviceSubcategory', 'categories'));
    }

// Update subcategory
    public function update(Request $request, $id)
    {
        $serviceSubcategory = ServiceSubcategory::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:service_categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:service_subcategories,slug,' . $serviceSubcategory->id,
            'description' => 'nullable|string',
        ]);

        $serviceSubcategory->update($request->all());

        return redirect()->route('service-subcategories.index')
            ->with('success', 'Subcategory updated successfully.');
    }
}
