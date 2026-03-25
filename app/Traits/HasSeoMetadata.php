<?php

namespace App\Traits;

trait HasSeoMetadata
{
    public function seoTitle(?string $locale = null): ?string
    {
        $locale ??= app()->getLocale();

        return $this->{"seo_title_{$locale}"} ?: $this->localize('title', $locale);
    }

    public function seoDescription(?string $locale = null): ?string
    {
        $locale ??= app()->getLocale();

        return $this->{"meta_description_{$locale}"} ?: $this->localize('short_description', $locale);
    }
}
