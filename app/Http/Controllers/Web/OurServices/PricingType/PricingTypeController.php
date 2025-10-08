<?php

namespace App\Http\Controllers\Web\OurServices\PricingType;

use App\Http\Controllers\Controller;
use App\Models\PricingType;
use Illuminate\Http\Request;

class PricingTypeController extends Controller
{
    public function index()
    {
        $pricingTypes = PricingType::paginate(10);
        return view('backend.layouts.ourServices.pricing_types.list', compact('pricingTypes'));
    }

    public function create()
    {
        return view('backend.layouts.ourServices.pricing_types.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:pricing_types,name',
        ]);

        PricingType::create($request->all());

        return redirect()->route('pricing-types.index')->with('success', 'Pricing type created successfully.');
    }

    public function edit($id)
    {
        $pricingType = PricingType::findOrFail($id);
        return view('backend.layouts.ourServices.pricing_types.edit', compact('pricingType'));
    }

    public function update(Request $request, $id)
    {
        $pricingType = PricingType::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:50|unique:pricing_types,name,' . $pricingType->id,
        ]);

        $pricingType->update($request->all());

        return redirect()->route('pricing-types.index')->with('success', 'Pricing type updated successfully.');
    }

    public function destroy($id)
    {
        $pricingType = PricingType::findOrFail($id);
        $pricingType->delete();

        return redirect()->route('pricing-types.index')->with('success', 'Pricing type deleted successfully.');
    }
}
