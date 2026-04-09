<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PetsExport;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::orderBy('id', 'desc')->paginate(12);
        return view('pets.index')->with('pets', $pets);
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'name'        => ['required', 'string'],
            'kind'        => ['required', 'string'],
            'weight'      => ['required', 'numeric'],
            'age'         => ['required', 'integer'],
            'breed'       => ['required', 'string'],
            'location'    => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'image'       => ['required', 'image'],
            'active'      => ['required'],
            'adopted'     => ['required'],
        ]);

        if ($validation) {
            if ($request->hasFile('image')) {
                $image = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/pets'), $image);
            }
        }

        $pet = new Pet;
        $pet->name        = $request->name;
        $pet->kind        = $request->kind;
        $pet->weight      = $request->weight;
        $pet->age         = $request->age;
        $pet->breed       = $request->breed;
        $pet->location    = $request->location;
        $pet->description = $request->description;
        $pet->image       = $image;
        $pet->active      = $request->active;
        $pet->adopted     = $request->adopted;

        if ($pet->save()) {
            return redirect('pets')
                ->with('message', 'The Pet: ' . $pet->name . ' was added successfully!');
        }
    }

    public function show(Pet $pet)
    {
        return view('pets.show')->with('pet', $pet);
    }

    public function edit(Pet $pet)
    {
        return view('pets.edit')->with('pet', $pet);
    }

    public function update(Request $request, Pet $pet)
    {
        $validation = $request->validate([
            'name'        => ['required', 'string'],
            'kind'        => ['required', 'string'],
            'weight'      => ['required', 'numeric'],
            'age'         => ['required', 'integer'],
            'breed'       => ['required', 'string'],
            'location'    => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'active'      => ['required'],
            'adopted'     => ['required'],
        ]);

        if ($validation) {
            if ($request->hasFile('image')) {
                $image = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/pets'), $image);
                if ($request->originimage != 'no-photo.png' && file_exists(public_path('images/pets/' . $pet->image))) {
                    unlink(public_path('images/pets/' . $pet->image));
                }
            } else {
                $image = $request->originimage;
            }
        }

        $pet->name        = $request->name;
        $pet->kind        = $request->kind;
        $pet->weight      = $request->weight;
        $pet->age         = $request->age;
        $pet->breed       = $request->breed;
        $pet->location    = $request->location;
        $pet->description = $request->description;
        $pet->image       = $image;
        $pet->active      = $request->active;
        $pet->adopted     = $request->adopted;

        if ($pet->save()) {
            return redirect('pets')
                ->with('message', 'The Pet: ' . $pet->name . ' was edited successfully!');
        }
    }

    public function destroy(Pet $pet)
    {
        if ($pet->delete()) {
            if ($pet->image != 'no-photo.png' && file_exists(public_path('images/pets/' . $pet->image))) {
                unlink(public_path('images/pets/' . $pet->image));
            }
            return redirect('pets')
                ->with('message', 'The Pet: ' . $pet->name . ' was deleted successfully!');
        }
    }

    public function pdf()
    {
        $pets = Pet::all();
        $pdf = Pdf::loadView('pets.pdf', compact('pets'));
        return $pdf->download('allpets.pdf');
    }

    public function excel()
    {
        return Excel::download(new PetsExport, 'allpets.xlsx');
    }

    public function search(Request $request)
    {
        $pets = Pet::names($request->q)->orderBy('id', 'desc')->paginate(12);
        return view('pets.search')->with('pets', $pets);
    }
}