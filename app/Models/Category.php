<?php

namespace App\Models;

use App\Traits\HasLocalizedAttributes;
use App\Traits\HasLocalizedSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory, HasLocalizedAttributes, HasLocalizedSlug;

    protected $fillable = [
        'name_fr',
        'name_en',
        'slug_fr',
        'slug_en',
    ];

    public function localizedSlugSources(): array
    {
        return [
            'slug_fr' => 'name_fr',
            'slug_en' => 'name_en',
        ];
    }

    public function trainings(): HasMany
    {
        return $this->hasMany(Training::class);
    }

    public function blogPosts(): HasMany
    {
        return $this->hasMany(BlogPost::class);
    }
}
