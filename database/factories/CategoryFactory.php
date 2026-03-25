<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $nameFr = fake()->unique()->words(2, true);
        $nameEn = fake()->unique()->words(2, true);

        return [
            'name_fr' => Str::title($nameFr),
            'name_en' => Str::title($nameEn),
            'slug_fr' => Str::slug($nameFr),
            'slug_en' => Str::slug($nameEn),
        ];
    }
}
