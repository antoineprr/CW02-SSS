<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Position;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team_id' => Team::factory(),
            'position_id' => Position::factory(),
            'country_id' => Country::factory(),
            'name' => fake()->lastName(),
            'firstname' => fake()->firstName(),
            'age' => fake()->numberBetween(18, 40),
            'description' => fake()->sentence(12),
        ];
    }
}
