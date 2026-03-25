<?php

namespace App\Models;

use App\Enums\SessionMode;
use App\Enums\SessionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_id',
        'trainer_id',
        'starts_at',
        'ends_at',
        'capacity',
        'mode',
        'city',
        'meeting_link',
        'status',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'mode' => SessionMode::class,
        'status' => SessionStatus::class,
    ];

    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }

    public function trainer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function remainingSeats(): int
    {
        return max(0, $this->capacity - $this->enrollments()->where('status', 'confirmed')->count());
    }
}
