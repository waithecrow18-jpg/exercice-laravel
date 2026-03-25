<?php

namespace Database\Factories;

use App\Enums\EnrollmentStatus;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EnrollmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'training_session_id' => TrainingSession::factory(),
            'reference' => 'INS-'.Str::upper(Str::random(8)),
            'status' => fake()->randomElement([
                EnrollmentStatus::Pending->value,
                EnrollmentStatus::Confirmed->value,
            ]),
            'note' => fake()->optional()->sentence(),
            'confirmed_at' => now()->subDays(rand(1, 10)),
            'cancelled_at' => null,
            'reminder_sent_at' => null,
        ];
    }
}
