<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeders
        $this->call([
            UserSeeder::class,
            PetSeeder::class,
            AdoptionSeeder::class

        ]);
        // Factory
        User::factory(50)->create();
        Pet::factory(50)->create();

    }
}