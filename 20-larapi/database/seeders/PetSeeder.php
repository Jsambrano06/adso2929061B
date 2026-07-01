<?php

namespace Database\Seeders;

use App\Models\Pet;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
    public function run(): void
    {
        $pets = [
            [
                'name' => 'Cooper',
                'kind' => 'Perro',
                'breed' => 'Golden Retriever',
                'weight' => 28.5,
                'age' => 3,
                'location' => 'Bogotá, Colombia',
                'description' => 'Cooper is a friendly and energetic golden retriever.',
            ],
            [
                'name' => 'Luna',
                'kind' => 'Perro',
                'breed' => 'Siberian Husky',
                'weight' => 22.0,
                'age' => 2,
                'location' => 'Medellín, Colombia',
                'description' => 'Luna loves long walks and cold weather.',
            ],
            [
                'name' => 'Mochi',
                'kind' => 'Gato',
                'breed' => 'Ragdoll Cat',
                'weight' => 4.5,
                'age' => 1,
                'location' => 'Cali, Colombia',
                'description' => 'Mochi is calm, playful, and very affectionate.',
            ],
        ];

        foreach ($pets as $pet) {
            Pet::create($pet);
        }
    }
}
