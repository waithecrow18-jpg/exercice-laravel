<?php

namespace Database\Factories;

use App\Enums\SessionMode;
use App\Enums\SessionStatus;
use App\Models\Training;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainingSessionFactory extends Factory
{
    public function definition(): array
    {
        $startsAt = now()->addDays(rand(5, 40));

        return [
            'training_id' => Training::factory(),
            'trainer_id' => User::factory(),
            'starts_at' => $startsAt,
            'ends_at' => (clone $startsAt)->addDays(rand(1, 3)),
            'capacity' => fake()->numberBetween(8, 25),
            'mode' => fake()->randomElement([
                SessionMode::InPerson->value,
                SessionMode::Online->value,
                SessionMode::Hybrid->value,
            ]),
            'city' => fake()->city(),
            'meeting_link' => fake()->url(),
            'status' => SessionStatus::Scheduled->value,
        ];
    }
}
