<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="auth-shell page-shell">
        <div class="auth-layout-grid">
            <aside class="auth-brand-panel">
                <div class="space-y-6">
                    <span class="eyebrow text-amber-300">{{ __('Learning experience') }}</span>
                    <div class="space-y-4">
                        <a href="{{ route('public.home', ['locale' => active_locale()]) }}" class="text-4xl font-semibold tracking-tight text-white">TrainUp Academy</a>
                        <p class="max-w-md text-base leading-7 text-white/78">
                            {{ __('Centralize bilingual training operations, track enrollments, and deliver a polished experience from public catalog to admin dashboard.') }}
                        </p>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-[1.5rem] border border-white/10 bg-white/10 p-5">
                        <p class="text-sm uppercase tracking-[0.2em] text-white/55">{{ __('Platform') }}</p>
                        <p class="mt-2 text-2xl font-semibold">{{ __('Laravel 10') }}</p>
                    </div>
                    <div class="rounded-[1.5rem] border border-white/10 bg-white/10 p-5">
                        <p class="text-sm uppercase tracking-[0.2em] text-white/55">{{ __('Languages') }}</p>
                        <p class="mt-2 text-2xl font-semibold">FR / EN</p>
                    </div>
                </div>
            </aside>

            <div class="flex items-center justify-center">
                <div class="auth-card">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
