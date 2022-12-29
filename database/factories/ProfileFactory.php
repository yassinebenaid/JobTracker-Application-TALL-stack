<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "country" => $this->faker->country(),
            "job" => $this->faker->jobTitle(),
            "bio" => $this->faker->paragraphs(5, true),
            "user_id" => $this->faker->unique()->numberBetween(1, 40)
        ];
    }
}
