<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(4);

        return [
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'user_id'     => User::inRandomOrder()->first()->id ?? User::factory(),
            'title'       => $title,
            'slug'        => Str::slug($title) . '-' . fake()->unique()->numberBetween(100, 999),
            'image'       => null,
            'content'     => fake()->paragraphs(5, true),
            'keywords'    => implode(',', fake()->words(5)),
            'description' => fake()->sentence(12),
        ];
    }
}
