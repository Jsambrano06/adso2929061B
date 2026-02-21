<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $petNames = ["Max","Bella","Charlie","Luna","Rocky","Milo","Coco","Toby","Daisy","Simba","Nala","Leo","Zeus","Chloe","Buddy","Lola","Jack","Lucy","Thor","Molly","Oliver","Bailey","Duke","Sasha","Rex","Mia","Bruno","Kira","Buster","Zoe",];
        $dogBreeds = ["Labrador Retriever","German Shepherd","Golden Retriever","Bulldog","Poodle","Beagle","Rottweiler","Yorkshire Terrier","Boxer",];
        $catBreeds = ["Persian","Siamese","Maine Coon","British Shoethair","Bengai",];
        $pigBreeds = ["Juliana","Vietnamese","Kunekune","Gottingen Minipig","Yucatan Minipig",];
        $birdBreeds = ["Budgerigan","cockatier","Lovebird","Canary","Hummingbird",];

        $kind =  fake()->randomElement(["Dog","Cat","Pig","Bird",]);

        switch ($kind) {
            case "Dog":
                $breed = fake()->randomElement($dogBreeds);
                break;
            case "Cat":
                $breed = fake()->randomElement($catBreeds);
                break;
            case "Pig":
                $breed = fake()->randomElement($pigBreeds);
                break;
            default;
                $breed = fake()->randomElement($birdBreeds);
                break;
        }


        return [
        'name'        => fake()->randomElement($petNames),
        'kind'        => $kind,
        'weight'      => fake()->numerify('#.#'),
        'age'         => fake()->numberBetween(1, 15),
        'breed'       => $breed,
        'location'    => fake()->city,
        'description' => fake()->sentence(5),
        ];
    }
}