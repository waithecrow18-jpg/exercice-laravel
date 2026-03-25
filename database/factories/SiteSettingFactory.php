<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SiteSettingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'key' => 'setting_'.Str::random(6),
            'value' => fake()->sentence(),
        ];
    }
}
