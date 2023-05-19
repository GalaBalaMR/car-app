<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $boolean = fake()->randomElement([true, false]);
        return [
            'name' => fake()->sentence(2),
            'is_registered' => $boolean,
            'registration_number' => $boolean == true ? fake()->randomNumber(5, true) : null,
            
        ];
    }
}
