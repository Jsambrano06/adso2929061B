<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::all();

        return response()->json([
            'message' => '✅ Query success',
            'pets' => $pets
        ]);
    }

    public function show($id)
    {
        $pet = Pet::find($id);

        if (!$pet) {
            return response()->json([
                'message' => '❌ Pet not found'
            ], 404);
        }

        return response()->json([
            'message' => '✅ Pet found',
            'pet' => $pet
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|string',
            'kind' => 'required|string|max:255',
            'weight' => 'nullable|numeric',
            'age' => 'nullable|integer',
            'breed' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'active' => 'nullable|boolean',
            'adopted' => 'nullable|boolean',
        ]);

        $pet = Pet::create([
            'name' => $validated['name'],
            'kind' => $validated['kind'],
            'breed' => $validated['breed'] ?? '',
            'weight' => $validated['weight'] ?? 0,
            'age' => $validated['age'] ?? 0,
            'location' => $validated['location'] ?? '',
            'description' => $validated['description'] ?? '',
            'image' => $validated['image'] ?? 'no-image.png',
            'active' => $validated['active'] ?? true,
            'adopted' => $validated['adopted'] ?? false,
        ]);

        return response()->json([
            'message' => '✅ Pet created successfully',
            'pet' => $pet
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $pet = Pet::find($id);

        if (!$pet) {
            return response()->json([
                'message' => '❌ Pet not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'image' => 'sometimes|nullable|string',
            'kind' => 'sometimes|required|string|max:255',
            'weight' => 'sometimes|nullable|numeric',
            'age' => 'sometimes|nullable|integer',
            'breed' => 'sometimes|nullable|string|max:255',
            'location' => 'sometimes|nullable|string|max:255',
            'description' => 'sometimes|nullable|string',
            'active' => 'sometimes|boolean',
            'adopted' => 'sometimes|boolean',
        ]);

        $pet->update($validated);

        return response()->json([
            'message' => '✅ Pet updated successfully',
            'pet' => $pet
        ], 200);
    }

    public function destroy($id)
    {
        $pet = Pet::find($id);

        if (!$pet) {
            return response()->json([
                'message' => '❌ Pet not found'
            ], 404);
        }

        $pet->delete();

        return response()->json([
            'message' => '✅ Pet deleted successfully'
        ]);
    }
}