<?php

namespace App\Console\Commands;

use App\Enums\EnrollmentStatus;
use App\Mail\SessionReminderMail;
use App\Models\Enrollment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendSessionReminders extends Command
{
    protected $signature = 'sessions:send-reminders';

    protected $description = 'Send reminder emails two days before a training session starts.';

    public function handle(): int
    {
        $enrollments = Enrollment::query()
            ->where('status', EnrollmentStatus::Confirmed)
            ->whereNull('reminder_sent_at')
            ->whereHas('session', function ($query): void {
                $query->whereBetween('starts_at', [
                    now()->addDays(2)->startOfDay(),
                    now()->addDays(2)->endOfDay(),
                ]);
            })
            ->with(['user', 'session.training'])
            ->get();

        foreach ($enrollments as $enrollment) {
            Mail::to($enrollment->user->email)->send(new SessionReminderMail($enrollment));
            $enrollment->update(['reminder_sent_at' => now()]);
        }

        $this->info("{$enrollments->count()} reminder(s) sent.");

        return self::SUCCESS;
    }
}
