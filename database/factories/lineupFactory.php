<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\lineup>
 */
class lineupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'set_name' => fake()->text(),
            'start_time' => fake()->dateTime(),
            'end_time' => fake()->dateTime()
        ];
    }
}
