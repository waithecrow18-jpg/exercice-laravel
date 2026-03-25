<?php

namespace App\Models;

use App\Enums\PublicationStatus;
use App\Traits\HasLocalizedAttributes;
use App\Traits\HasLocalizedSlug;
use App\Traits\HasSeoMetadata;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogPost extends Model
{
    use HasFactory, HasLocalizedAttributes, HasLocalizedSlug, HasSeoMetadata;

    protected $fillable = [
        'title_fr',
        'title_en',
        'slug_fr',
        'slug_en',
        'content_fr',
        'content_en',
        'category_id',
        'author_id',
        'status',
        'published_at',
        'seo_title_fr',
        'seo_title_en',
        'meta_description_fr',
        'meta_description_en',
    ];

    protected $casts = [
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

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
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
