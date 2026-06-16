<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WorkFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(rand(2, 5), true),
            'release_year' => $this->faker->numberBetween(2000, 2024),
            'description' => $this->faker->paragraph(3),
        ];
    }
}