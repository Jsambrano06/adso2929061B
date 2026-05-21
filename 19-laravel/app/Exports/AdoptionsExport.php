<?php

namespace App\Exports;

use App\Models\Adoption;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class AdoptionsExport implements FromView
{
    public function view(): View
    {
        $adopts = Adoption::with(['user', 'pet'])->get();
        return view('adoptions.excel', compact('adopts'));
    }
}
