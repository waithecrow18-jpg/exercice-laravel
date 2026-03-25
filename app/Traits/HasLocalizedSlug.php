<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasLocalizedSlug
{
    protected static function bootHasLocalizedSlug(): void
    {
        static::saving(function ($model): void {
            foreach ($model->localizedSlugSources() as $slugField => $sourceField) {
                if (! $model->{$sourceField}) {
                    continue;
                }

                $baseSlug = Str::slug($model->{$sourceField});
                $slug = $baseSlug;
                $counter = 1;

                while (static::query()
                    ->where($slugField, $slug)
                    ->when($model->exists, fn ($query) => $query->whereKeyNot($model->getKey()))
                    ->exists()) {
                    $slug = "{$baseSlug}-{$counter}";
                    $counter++;
                }

                $model->{$slugField} = $slug;
            }
        });
    }

    abstract public function localizedSlugSources(): array;
}
