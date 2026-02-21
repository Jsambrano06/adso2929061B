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
        // Eloquent : ORM
        $pet = new Pet;
        $pet->name = 'Rocko';
        $pet->kind = 'dog';
        $pet->weight = 4;
        $pet->age = 6;
        $pet->bread = 'creole';
        $pet->location = 'villamaria caldas';
        $pet->description = 'He is a calm dog and is friendly to everyone.';
        
        $pet->save();

        $pet =new Pet;
        $pet->name = 'Tiger';
        $pet->kind = 'cat';
        $pet->weight = 2;
        $pet->age = 8;
        $pet->bread = 'orange';
        $pet->location = 'villamaria caldas';
        $pet->description = 'He is a calm and sleepy cat.';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Juan';
        $pet->kind = 'Horse';
        $pet->weight = 16;
        $pet->age = 2;
        $pet->bread = 'friesian';
        $pet->location = 'Llanitos villamaria Caldas';
        $pet->description = 'He is a beautiful and calm horse who loves to trot all over the countryside, happy with life.';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Roberto';
        $pet->kind = 'pig';
        $pet->weight = 5;
        $pet->age = 1;
        $pet->bread = 'mini pig';
        $pet->location = 'buenaventura Valle del cauca';
        $pet->description = 'Its a pig that eats people and loves pork.';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'chilindrina';
        $pet->kind = 'cow';
        $pet->weight = 15;
        $pet->age = 3;
        $pet->bread = 'angus';
        $pet->location = 'Bereira risaralda';
        $pet->description = 'Shes a quiet cow, bored of living in Bereira.';
        $pet->save();
    }
}
