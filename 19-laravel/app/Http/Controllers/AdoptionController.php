<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\User;
use App\Models\Pet;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AdoptionsExport;

class AdoptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adopts = Adoption::with(['user', 'pet'])->paginate(12);
        return view('adoptions.index')->with('adopts', $adopts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        // Only get pets that are active and not yet adopted
        $pets = Pet::where('active', 1)->where('adopted', 0)->get();
        return view('adoptions.create')->with('users', $users)->with('pets', $pets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'pet_id'  => 'required'
        ]);

        $adoption = new Adoption();
        $adoption->user_id = $request->user_id;
        $adoption->pet_id  = $request->pet_id;

        if ($adoption->save()) {
            $pet = Pet::find($request->pet_id);
            if ($pet) {
                $pet->adopted = 1;
                $pet->active = 0;
                $pet->save();
            }
            return redirect('adoptions')->with('message', 'The adoption was created successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Adoption $adoption)
    {
        $adoption->load(['user', 'pet']);
        return view('adoptions.show')->with('adopt', $adoption);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Adoption $adoption)
    {
        $pet = $adoption->pet;
        if ($pet) {
            $pet->adopted = 0;
            $pet->active = 1;
            $pet->save();
        }

        if ($adoption->delete()) {
            return redirect('adoptions')->with('message', 'The adoption was deleted successfully!');
        }
    }

    /**
     * Generate a PDF file
     */
    public function pdf()
    {
        $adopts = Adoption::with(['user', 'pet'])->get();
        $pdf = Pdf::loadView('adoptions.pdf', compact('adopts'));
        return $pdf->download('adoptions-' . date('Y-m-d') . '.pdf');
    }

    /**
     * Generate a Excel file
     */
    public function excel()
    {
        return Excel::download(new AdoptionsExport, 'adoptions-' . date('Y-m-d') . '.xlsx');
    }

    /**
     * Search adoptions
     */
    public function search(Request $request)
    {
        $q = $request->input('q');

        $adopts = Adoption::with(['user', 'pet'])
            ->whereHas('pet', function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%");
            })
            ->orWhereHas('user', function ($query) use ($q) {
                $query->where('fullname', 'like', "%{$q}%");
            })
            ->paginate(12);

        return view('adoptions.search')->with('adopts', $adopts);
    }
}
