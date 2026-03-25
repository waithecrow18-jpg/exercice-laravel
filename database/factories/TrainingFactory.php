<?php

namespace Database\Factories;

use App\Enums\PublicationStatus;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'title_fr' => fake()->unique()->sentence(3),
            'title_en' => fake()->unique()->sentence(3),
            'short_description_fr' => fake()->sentence(12),
            'short_description_en' => fake()->sentence(12),
            'full_description_fr' => fake()->paragraphs(4, true),
            'full_description_en' => fake()->paragraphs(4, true),
            'image_path' => null,
            'price' => fake()->randomFloat(2, 300, 2400),
            'duration_hours' => fake()->randomElement([8, 12, 16, 24]),
            'level' => fake()->randomElement(['Beginner', 'Intermediate', 'Advanced']),
            'status' => PublicationStatus::Published->value,
            'published_at' => now()->subDays(rand(1, 20)),
            'seo_title_fr' => fake()->sentence(5),
            'seo_title_en' => fake()->sentence(5),
            'meta_description_fr' => fake()->sentence(10),
            'meta_description_en' => fake()->sentence(10),
        ];
    }
}
