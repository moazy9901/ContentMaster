<?php
namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
class AddressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'student_id'  => Student::inRandomOrder()->first()->id ?? Student::factory(),
            'name'        => fake()->name(),
            'details'     => fake()->streetAddress(),
            'country'     => fake()->country(),
            'city'        => fake()->city(),
            'governorate' => fake()->state(),
            'flag'        => fake()->boolean(),
        ];
    }
}
