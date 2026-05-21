<?php

namespace App\Exports;

use App\Models\Pet;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class PetsExport implements FromView
{
    public function view(): View
    {
        $pets = Pet::all();
        return view('pets.excel', compact('pets'));
    }
}