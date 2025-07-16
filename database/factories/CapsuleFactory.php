<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Capsule>
 */
class CapsuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $latitude = $this->faker->latitude;
        $longitude = $this->faker->longitude;

        return [
            "user_id" => 0,
            "title" => $this->faker->unique()->words(3, true),
            "message" => $this->faker->paragraph,
            "gps_location" => "$latitude,$longitude",
            "ip_address" => $this->faker->localIpv4(),
            "reveal_date" => $this->faker->date(),
            "visibility" => $this->faker->randomElement(["private", "public", "unlisted"]),
            "mode" => $this->faker->randomElement(["regular", "surprise"]),
            "color" => $this->faker->randomElement(["red", "yellow", "green", "blue", "pink"]),
            "emoji" => $this->faker->randomElement(["happy", "smile", "meh", "sad", "angry"]),
            "is_revealed" => 0,
        ];
    }
}
