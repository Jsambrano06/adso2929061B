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
        try {

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'nullable|string|max:255',
                'kind' => 'required|string|max:255',
                'weight' => 'nullable|numeric',
                'age' => 'nullable|integer',
                'bread' => 'nullable|string|max:255',
                'location' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'active' => 'nullable|boolean',
                'adopted' => 'nullable|boolean',
            ]);

            $pet = Pet::create(array_merge($validated, [
                'active' => $validated['active'] ?? true,
                'adopted' => $validated['adopted'] ?? false,
            ]));

            return response()->json([
                'message' => '✅ Pet created successfully',
                'pet' => $pet
            ], 201);

        } catch (\Exception $e) {

            return response()->json([
                'message' => '❌ Error creating pet',
                'error' => $e->getMessage()
            ], 500);
        }
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
            'image' => 'sometimes|nullable|string|max:255',
            'kind' => 'sometimes|required|string|max:255',
            'weight' => 'sometimes|nullable|numeric',
            'age' => 'sometimes|nullable|integer',
            'bread' => 'sometimes|nullable|string|max:255',
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