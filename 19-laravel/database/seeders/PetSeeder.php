<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pet;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pet = new Pet;
        $pet->name = 'Luna';
        $pet->kind = 'cat';
        $pet->weight = 3;
        $pet->age = 2;
        $pet->bread = 'Persian mix';
        $pet->location = 'Medellin, Antioquia';
        $pet->description = 'She is a playful cat who loves sunny spots and cuddles.';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Max';
        $pet->kind = 'dog';
        $pet->weight = 12;
        $pet->age = 4;
        $pet->bread = 'Labrador Retriever';
        $pet->location = 'Cali, Valle del Cauca';
        $pet->description = 'He is energetic and enjoys long walks in the park.';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Canela';
        $pet->kind = 'dog';
        $pet->weight = 8;
        $pet->age = 5;
        $pet->bread = 'Criollo';
        $pet->location = 'Bogota, Cundinamarca';
        $pet->description = 'She is very loyal and protective with her family.';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Simba';
        $pet->kind = 'cat';
        $pet->weight = 5;
        $pet->age = 3;
        $pet->bread = 'Maine Coon mix';
        $pet->location = 'Cartagena, Bolivar';
        $pet->description = 'He is curious and loves exploring every corner of the house.';
        $pet->save();
    }
}
