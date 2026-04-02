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
        $participantId = User::role('Participant')->inRandomOrder()->value('id')
            ?: User::query()->inRandomOrder()->value('id')
            ?: User::factory();
        $sessionId = TrainingSession::query()->inRandomOrder()->value('id') ?: TrainingSession::factory();

        return [
            'user_id' => $participantId,
            'training_session_id' => $sessionId,
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
