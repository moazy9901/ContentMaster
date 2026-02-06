<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'customer_id'  => Customer::inRandomOrder()->first()->id ?? Customer::factory(),
            'name'        => fake()->name(),
            'details'     => fake()->streetAddress(),
            'country'     => fake()->country(),
            'city'        => fake()->city(),
            'governorate' => fake()->state(),
            'flag'        => fake()->boolean(),
        ];
    }
}
