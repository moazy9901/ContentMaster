<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class CustomerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'phone' => '01' . fake()->randomElement(['0','1','2','5']). fake()->numberBetween(10000000, 99999999),
            'image' => null,
            'gender' => fake()->randomElement(['male', 'female'])
        ];
    }
}
