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
        $dogbreads = ["Labrador Retriever","German Shepherd","Golden Retriever","Bulldog","Poodle","Beagle","Rottweiler","Yorkshire Terrier","Boxer",];
        $catbreads = ["Persian","Siamese","Maine Coon","British Shoethair","Bengai",];
        $pigbreads = ["Juliana","Vietnamese","Kunekune","Gottingen Minipig","Yucatan Minipig",];
        $birdbreads = ["Budgerigan","cockatier","Lovebird","Canary","Hummingbird",];

        $kind =  fake()->randomElement(["Dog","Cat","Pig","Bird",]);

        switch ($kind) {
            case "Dog":
                $bread = fake()->randomElement($dogbreads);
                break;
            case "Cat":
                $bread = fake()->randomElement($catbreads);
                break;
            case "Pig":
                $bread = fake()->randomElement($pigbreads);
                break;
            default;
                $bread = fake()->randomElement($birdbreads);
                break;
        }


        return [
        'name'        => fake()->randomElement($petNames),
        'kind'        => $kind,
        'weight'      => fake()->numerify('#.#'),
        'age'         => fake()->numberBetween(1, 15),
        'bread'       => $bread,
        'location'    => fake()->city,
        'description' => fake()->sentence(5),
        ];
    }
}