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
        // Mascotas existentes (5)
        $pet = new Pet;
        $pet->name = 'Rocko';
        $pet->kind = 'dog';
        $pet->weight = 4;
        $pet->age = 6;
        $pet->breed = 'creole';
        $pet->location = 'villamaria caldas';
        $pet->description = 'He is a calm dog and is friendly to everyone.';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Tiger';
        $pet->kind = 'cat';
        $pet->weight = 2;
        $pet->age = 8;
        $pet->breed = 'orange';
        $pet->location = 'villamaria caldas';
        $pet->description = 'He is a calm and sleepy cat.';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Juan';
        $pet->kind = 'Horse';
        $pet->weight = 16;
        $pet->age = 2;
        $pet->breed = 'friesian';
        $pet->location = 'Llanitos villamaria Caldas';
        $pet->description = 'He is a beautiful and calm horse who loves to trot all over the countryside, happy with life.';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Roberto';
        $pet->kind = 'pig';
        $pet->weight = 5;
        $pet->age = 1;
        $pet->breed = 'mini pig';
        $pet->location = 'buenaventura Valle del cauca';
        $pet->description = 'Its a pig that eats people and loves pork.';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'chilindrina';
        $pet->kind = 'cow';
        $pet->weight = 15;
        $pet->age = 3;
        $pet->breed = 'angus';
        $pet->location = 'Bereira risaralda';
        $pet->description = 'Shes a quiet cow, bored of living in Bereira.';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Luna';
        $pet->kind = 'dog';
        $pet->weight = 8;
        $pet->age = 3;
        $pet->breed = 'Golden Retriever';
        $pet->location = 'Manizales Caldas';
        $pet->description = 'She is an energetic dog who loves to play fetch and swim in the river.';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Michi';
        $pet->kind = 'cat';
        $pet->weight = 3;
        $pet->age = 2;
        $pet->breed = 'Siamese';
        $pet->location = 'Pereira Risaralda';
        $pet->description = 'A curious cat who loves to explore and climb trees. Very vocal and affectionate.';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Pepe';
        $pet->kind = 'bird';
        $pet->weight = 1;
        $pet->age = 5;
        $pet->breed = 'African Grey';
        $pet->location = 'Armenia Quindío';
        $pet->description = 'He can talk and mimic sounds. Loves to whistle and say "Hola".';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Copito';
        $pet->kind = 'rabbit';
        $pet->weight = 2;
        $pet->age = 1;
        $pet->breed = 'Holland Lop';
        $pet->location = 'Chinchiná Caldas';
        $pet->description = 'A fluffy white rabbit who loves carrots and jumping around the garden.';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Ruedita';
        $pet->kind = 'rodent';
        $pet->weight = 0.5;
        $pet->age = 1;
        $pet->breed = 'Syrian Hamster';
        $pet->location = 'Santa Rosa de Cabal';
        $pet->description = 'Tiny and fast, loves to run on his wheel all night long.';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Manuelita';
        $pet->kind = 'turtle';
        $pet->weight = 3;
        $pet->age = 15;
        $pet->breed = 'Red-eared Slider';
        $pet->location = 'Neira Caldas';
        $pet->description = 'A wise old turtle who enjoys sunbathing on rocks and swimming slowly.';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Nemo';
        $pet->kind = 'fish';
        $pet->weight = 0.2;
        $pet->age = 1;
        $pet->breed = 'Clownfish';
        $pet->location = 'Acuario de Manizales';
        $pet->description = 'Bright orange and white fish who loves swimming among anemones.';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Bruno';
        $pet->kind = 'dog';
        $pet->weight = 25;
        $pet->age = 4;
        $pet->breed = 'German Shepherd';
        $pet->location = 'Dosquebradas';
        $pet->description = 'Protective and loyal, great with kids and very intelligent.';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Canela';
        $pet->kind = 'cat';
        $pet->weight = 4;
        $pet->age = 3;
        $pet->breed = 'Persian';
        $pet->location = 'La Dorada Caldas';
        $pet->description = 'Long-haired beauty with a calm temperament. Loves to be brushed.';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Relámpago';
        $pet->kind = 'horse';
        $pet->weight = 18;
        $pet->age = 7;
        $pet->breed = 'Arabian';
        $pet->location = 'Chinchiná Caldas';
        $pet->description = 'Fast and elegant, winner of local competitions. Very noble.';
        $pet->save();
    }
}
