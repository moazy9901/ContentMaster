<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'email'=>fake()->unique()->safeEmail(),
            'password'=>Hash::make('password'),
            'phone'=>fake()->phoneNumber(),
            'img'=>null,
            'gender'=>fake()->randomElement(['male' , 'female'])
        ];
    }
}
