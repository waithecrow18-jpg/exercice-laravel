<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactMessageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'subject' => fake()->sentence(4),
            'message' => fake()->paragraph(3),
            'locale' => fake()->randomElement(['fr', 'en']),
            'read_at' => fake()->optional()->dateTimeBetween('-5 days', 'now'),
        ];
    }
}
