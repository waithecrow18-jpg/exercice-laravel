<?php

namespace App\Traits;

trait HasLocalizedAttributes
{
    public function localize(string $attribute, ?string $locale = null): ?string
    {
        $locale ??= app()->getLocale();
        $fallbackLocale = config('app.fallback_locale', 'en');
        $localizedAttribute = "{$attribute}_{$locale}";
        $fallbackAttribute = "{$attribute}_{$fallbackLocale}";

        return $this->{$localizedAttribute} ?: $this->{$fallbackAttribute};
    }
}
