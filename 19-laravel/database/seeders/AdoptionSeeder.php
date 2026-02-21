<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Adoption;
use App\Models\Pet;

class AdoptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adopt = new Adoption;
        $adopt->user_id = 2;
        $adopt->pet_id = 3;
        if ($adopt->save()) {
            $pet = pet::find((2));
            $pet->adopted = 1;
            $pet->save();
        }

        $adopt = new Adoption;
        $adopt->user_id = 2;
        $adopt->pet_id = 2;
        if ($adopt->save()) {
            $pet = pet::find((4));
            $pet->adopted = 1;
            $pet->save();
        }
    }
}
