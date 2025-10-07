<?php

namespace App\Http\Controllers\Web\GlobalElectricianDay;

use App\Http\Controllers\Controller;
use App\Models\Movement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovementController extends Controller
{
    // List all movements
    public function index()
    {
        $movements = Movement::all(); // Or paginate if needed
        return view('backend.layouts.cms.global-electrician-day-movement.list', compact('movements'));
    }

    // Show create form
    public function create()
    {
        return view('backend.layouts.cms.global-electrician-day-movement.add');
    }

    // Store new movement
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title.*' => 'required|string',
            'description.*.*' => 'nullable|string',
        ]);

        $data = $request->only(['title', 'description']);

        // Handle image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('movements', 'public');
        }

        Movement::create($data);

        return redirect()->route('movements.index')->with('success', 'Movement created successfully.');
    }

    // Show edit form
    public function edit(Movement $movement)
    {
        return view('backend.layouts.cms.global-electrician-day-movement.edit', compact('movement'));
    }


// Update function
    public function update(Request $request, $id)
    {
        $movement = Movement::findOrFail($id);

        $request->validate([
            'title.*' => 'required|string',
            'description.*' => 'array',
            'image' => 'nullable|image|max:2048',
        ]);

        $movement->title = $request->title;
        $movement->description = $request->description;

        if ($request->hasFile('image')) {
            if ($movement->image && Storage::exists($movement->image)) {
                Storage::delete($movement->image);
            }
            $movement->image = $request->file('image')->store('movements', 'public');
        }

        $movement->save();

        return redirect()->route('movements.index')->with('success', 'Movement updated successfully.');
    }

    // Delete movement
    public function destroy(Movement $movement)
    {
        if ($movement->image && Storage::disk('public')->exists($movement->image)) {
            Storage::disk('public')->delete($movement->image);
        }

        $movement->delete();

        return redirect()->route('movements.index')
            ->with('success', 'Movement deleted successfully.');
    }
}
