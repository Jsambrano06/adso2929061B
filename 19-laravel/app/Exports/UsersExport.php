<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::select('document', 'fullname', 'gender', 'birthdate', 'phone', 'email')->get();
    }

    public function headings(): array
    {
        return [
            'Document',
            'Full Name',
            'Gender',
            'Birthdate',
            'Phone',
            'Email'
        ];
    }
}
