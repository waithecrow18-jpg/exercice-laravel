<?php

namespace App\Console\Commands;

use App\Enums\PublicationStatus;
use App\Models\Training;
use Illuminate\Console\Command;

class ArchiveFinishedTrainings extends Command
{
    protected $signature = 'trainings:archive-finished';

    protected $description = 'Archive trainings whose sessions have all ended.';

    public function handle(): int
    {
        $archivedCount = 0;

        Training::query()
            ->where('status', PublicationStatus::Published)
            ->withMax('sessions', 'ends_at')
            ->get()
            ->filter(fn (Training $training) => $training->sessions_max_ends_at && $training->sessions_max_ends_at < now())
            ->each(function (Training $training) use (&$archivedCount): void {
                $training->update(['status' => PublicationStatus::Archived]);
                $archivedCount++;
            });

        $this->info("{$archivedCount} training(s) archived.");

        return self::SUCCESS;
    }
}
