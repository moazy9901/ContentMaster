<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(2, true);

        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'image' => null, // يمكنك وضع صورة وهمية لاحقًا
            'meta_title' => ucfirst($name) . ' | Website',
            'meta_description' => $this->faker->sentence(12),
            'meta_keywords' => implode(',', $this->faker->words(5)),
        ];
    }
}
