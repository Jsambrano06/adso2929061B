<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PetsExport;
use Illuminate\Validation\Rule;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pet::orderBy('id', 'desc')->paginate(12);
        return view('pets.index')->with('pets', $pets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'unique:' . Pet::class],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'kind' => ['required', 'string', 'in:Perro,Gato'],
            'weight' => ['required', 'numeric', 'min:0'],
            'age' => ['required', 'numeric', 'min:0'],
            'breed' => ['required', 'string'],
            'location' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        // Manejar la imagen
        $imageName = 'no-photo.png';
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/pets'), $imageName);
        }

        // Crear la mascota
        $pet = new Pet();
        $pet->name = $request->name;
        $pet->image = $imageName;
        $pet->kind = $request->kind;
        $pet->weight = $request->weight;
        $pet->age = $request->age;
        $pet->breed = $request->breed;
        $pet->location = $request->location;
        $pet->description = $request->description;
        $pet->active = 1;
        $pet->adopted = 0;

        if ($pet->save()) {
            return redirect('pets')
                ->with('message', 'The Pet: ' . $pet->name . ' was added successfully!');
        }

        return back()->with('error', 'Error adding pet')->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
        return view('pets.show')->with('pet', $pet);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        return view('pets.edit', compact('pet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pet $pet)
    {
        $request->validate([
            'name' => ['required', 'string', Rule::unique('pets')->ignore($pet->id)],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'kind' => ['required', 'string'],
            'weight' => ['required', 'numeric'],
            'age' => ['required', 'numeric'],
            'breed' => ['required', 'string'],
            'location' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        $pet->name = $request->name;
        $pet->kind = $request->kind;
        $pet->weight = $request->weight;
        $pet->age = $request->age;
        $pet->breed = $request->breed;
        $pet->location = $request->location;
        $pet->description = $request->description;

        // Manejar la imagen
        if ($request->hasFile('image')) {
            if ($pet->image && $pet->image != 'no-photo.png') {
                $oldImagePath = public_path('images/pets/' . $pet->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/pets'), $imageName);
            $pet->image = $imageName;
        }

        if ($pet->save()) {
            return redirect('pets')
                ->with('message', 'The Pet: ' . $pet->name . ' was updated successfully!');
        }

        return back()->with('error', 'Error updating pet');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        if ($pet->image != 'no-photo.png' && file_exists(public_path('images/pets/' . $pet->image))) {
            unlink(public_path('images/pets/' . $pet->image));
        }

        if ($pet->delete()) {
            return redirect('pets')
                ->with('message', 'The Pet: ' . $pet->name . ' was deleted successfully!');
        }

        return back()->with('error', 'Error deleting pet');
    }

    /**
     * Search pets - CORREGIDO como Users
     */
    public function search(Request $request)
{
    $q = $request->input('q');
    $pets = Pet::where('name', 'like', '%' . $q . '%')
        ->orWhere('kind', 'like', '%' . $q . '%')
        ->orWhere('breed', 'like', '%' . $q . '%')
        ->orderBy('id', 'desc')
        ->paginate(12);
    
    return view('pets.search', compact('pets'));
}

    /**
     * Generate a PDF file
     */
    public function pdf()
    {
        $pets = Pet::all();
        $pdf = Pdf::loadView('pets.pdf', compact('pets'));
        return $pdf->download('mascotas-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Generate a Excel file
     */
    public function excel()
    {
        return Excel::download(new PetsExport, 'mascotas-' . date('Y-m-d') . '.xlsx');
    }
}