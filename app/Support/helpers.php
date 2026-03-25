<?php

use App\Models\SiteSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

if (! function_exists('active_locale')) {
    function active_locale(): string
    {
        return app()->getLocale();
    }
}

if (! function_exists('price_format')) {
    function price_format(float|int|string|null $amount, string $currency = 'MAD'): string
    {
        if ($amount === null || $amount === '') {
            return '0 '.$currency;
        }

        return number_format((float) $amount, 2, ',', ' ').' '.$currency;
    }
}

if (! function_exists('site_setting')) {
    function site_setting(string $key, mixed $default = null): mixed
    {
        return Cache::remember("site_setting_{$key}", now()->addHour(), function () use ($key, $default) {
            return SiteSetting::query()->where('key', $key)->value('value') ?? $default;
        });
    }
}

if (! function_exists('page_title')) {
    function page_title(?string $title = null): string
    {
        $siteName = site_setting('site_name', 'TrainUp Academy');

        return $title ? "{$title} | {$siteName}" : $siteName;
    }
}

if (! function_exists('status_badge_class')) {
    function status_badge_class(string $status): string
    {
        return match ($status) {
            'active', 'published', 'confirmed', 'scheduled' => 'bg-emerald-100 text-emerald-700',
            'pending', 'draft' => 'bg-amber-100 text-amber-700',
            'inactive', 'cancelled', 'archived' => 'bg-rose-100 text-rose-700',
            default => 'bg-slate-100 text-slate-700',
        };
    }
}

if (! function_exists('encrypted_id')) {
    function encrypted_id(Model|int|string $value): string
    {
        $identifier = $value instanceof Model ? $value->getKey() : $value;

        return urlencode(Crypt::encryptString((string) $identifier));
    }
}
