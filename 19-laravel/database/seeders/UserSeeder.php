<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =new User;
        $user->document = 75000001;
        $user->fullname = 'John Wick';
        $user->gender = 'Male';
        $user->birthdate = '1964-09-02';
        $user->phone = 3100000001;
        $user->email = 'johnw@mail.com';
        $user->password = bcrypt('admin');
        $user->role = 'Admin';
        $user->save();

        DB::table('users')->insert([
        'document' => 75000002,
        'fullname' => 'Lara Croft',
        'gender' => 'Female',
        'birthdate' => '1968-02-14',
        'phone' => 3100000002,
        'email' => 'larac@mail.com',
        'password' => bcrypt('12345'),
        'created_at' => now(),
        'updated_at' => now(),
        ]);
    }
}
