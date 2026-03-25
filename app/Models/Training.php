<?php

namespace App\Models;

use App\Enums\PublicationStatus;
use App\Traits\HasLocalizedAttributes;
use App\Traits\HasLocalizedSlug;
use App\Traits\HasSeoMetadata;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Training extends Model
{
    use HasFactory, HasLocalizedAttributes, HasLocalizedSlug, HasSeoMetadata;

    protected $fillable = [
        'category_id',
        'title_fr',
        'title_en',
        'slug_fr',
        'slug_en',
        'short_description_fr',
        'short_description_en',
        'full_description_fr',
        'full_description_en',
        'image_path',
        'price',
        'duration_hours',
        'level',
        'status',
        'published_at',
        'seo_title_fr',
        'seo_title_en',
        'meta_description_fr',
        'meta_description_en',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'published_at' => 'datetime',
        'status' => PublicationStatus::class,
    ];

    public function localizedSlugSources(): array
    {
        return [
            'slug_fr' => 'title_fr',
            'slug_en' => 'title_en',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(TrainingSession::class);
    }

    public function scopePublished($query)
    {
        return $query
            ->where('status', PublicationStatus::Published)
            ->where(function ($subQuery): void {
                $subQuery->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }
}
