<?php

namespace Database\Factories;

use App\Enums\JobTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            "title" => $this->faker->sentence(4),
            "description" => $this->faker->paragraphs(6, true),
            "salary" => $this->faker->numberBetween(1000, 100000),
            "type" => JobTypes::cases()[$this->faker->numberBetween(1, 4)]->value,
            "country" => $this->faker->country(),
            "city" => $this->faker->city(),
            "user_id" => $this->faker->numberBetween(2, 40),
            "criteria" => json_encode(['more than 4 years of exp', "human being", 'not married and not single'])
        ];
    }
}
