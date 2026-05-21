<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'document' => $row['document'],
            'fullname' => $row['fullname'],
            'gender' => $row['gender'],
            'birthdate' => $row['birthdate'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'password' => Hash::make('default123'), // Contraseña por defecto
            'photo' => 'no-photo.png'
        ]);
    }
}
