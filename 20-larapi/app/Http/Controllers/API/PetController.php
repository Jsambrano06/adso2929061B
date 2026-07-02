<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

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

    private function saveImageFile($imageFile)
    {
        if (!$imageFile || !$imageFile->isValid()) {
            return null;
        }

        $directory = public_path('pets');
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $extension = $imageFile->getClientOriginalExtension() ?: 'jpg';
        $filename = Str::uuid()->toString() . '.' . $extension;
        $imageFile->move($directory, $filename);

        return $filename;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],
            'kind' => 'required|string|max:255',
            'weight' => 'nullable|numeric',
            'age' => 'nullable|integer',
            'bread' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'active' => 'nullable|boolean',
            'adopted' => 'nullable|boolean',
        ]);

        $image = $this->saveImageFile($request->file('image'));

        $pet = Pet::create([
            'name' => $validated['name'],
            'kind' => $validated['kind'],
            'bread' => $validated['bread'] ?? '',
            'weight' => $validated['weight'] ?? 0,
            'age' => $validated['age'] ?? 0,
            'location' => $validated['location'] ?? '',
            'description' => $validated['description'] ?? '',
            'image' => $image ?? 'no-image.png',
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
            'image' => ['sometimes', 'nullable', 'file', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],
            'kind' => 'sometimes|required|string|max:255',
            'weight' => 'sometimes|nullable|numeric',
            'age' => 'sometimes|nullable|integer',
            'bread' => 'sometimes|nullable|string|max:255',
            'location' => 'sometimes|nullable|string|max:255',
            'description' => 'sometimes|nullable|string',
            'active' => 'sometimes|boolean',
            'adopted' => 'sometimes|boolean',
        ]);

        $payload = $validated;
        if ($request->hasFile('image')) {
            $payload['image'] = $this->saveImageFile($request->file('image')) ?? 'no-image.png';
        } elseif (array_key_exists('image', $payload) && $payload['image'] === null) {
            $payload['image'] = null;
        }

        $pet->update($payload);

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

        DB::transaction(function () use ($pet) {
            if (Schema::hasTable('adoptions') && Schema::hasColumn('adoptions', 'pet_id')) {
                DB::table('adoptions')->where('pet_id', $pet->id)->delete();
            }

            if ($pet->image && $pet->image !== 'no-image.png') {
                $imagePath = public_path('pets/' . $pet->image);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            $pet->delete();
        });

        return response()->json([
            'message' => '✅ Pet deleted successfully'
        ]);
    }
}