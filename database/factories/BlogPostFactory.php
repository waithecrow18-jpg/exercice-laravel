<?php

namespace Database\Factories;

use App\Enums\PublicationStatus;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'author_id' => User::factory(),
            'title_fr' => fake()->unique()->sentence(4),
            'title_en' => fake()->unique()->sentence(4),
            'content_fr' => fake()->paragraphs(5, true),
            'content_en' => fake()->paragraphs(5, true),
            'status' => PublicationStatus::Published->value,
            'published_at' => now()->subDays(rand(1, 30)),
            'seo_title_fr' => fake()->sentence(5),
            'seo_title_en' => fake()->sentence(5),
            'meta_description_fr' => fake()->sentence(10),
            'meta_description_en' => fake()->sentence(10),
        ];
    }
}
