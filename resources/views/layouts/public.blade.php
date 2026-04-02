@php
    $locale = $locale ?? active_locale();
    $trainingIndexRoute = $locale === 'fr' ? 'public.trainings.index.fr' : 'public.trainings.index.en';
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ page_title($title ?? null) }}</title>
    <meta name="description" content="{{ $metaDescription ?? site_setting('site_tagline') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="public-shell page-shell">
    <div class="public-frame">
        <header class="public-topbar">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="space-y-2">
                    <span class="eyebrow">{{ __('Bilingual learning platform') }}</span>
                    <div>
                        <a href="{{ route('public.home', ['locale' => $locale]) }}" class="text-2xl font-semibold tracking-tight text-slate-900">TrainUp Academy</a>
                        <p class="text-sm text-slate-500">{{ site_setting('site_tagline') }}</p>
                    </div>
                </div>
                <nav class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('public.home', ['locale' => $locale]) }}" class="nav-pill {{ request()->routeIs('public.home') ? 'is-active' : '' }}">{{ __('Home') }}</a>
                    <a href="{{ route($trainingIndexRoute, ['locale' => $locale]) }}" class="nav-pill {{ request()->routeIs('public.trainings.*') ? 'is-active' : '' }}">{{ __('Trainings') }}</a>
                    <a href="{{ route('public.blog.index', ['locale' => $locale]) }}" class="nav-pill {{ request()->routeIs('public.blog.*') ? 'is-active' : '' }}">{{ __('Blog') }}</a>
                    <a href="{{ route('public.contact', ['locale' => $locale]) }}" class="nav-pill {{ request()->routeIs('public.contact*') ? 'is-active' : '' }}">{{ __('Contact') }}</a>
                    <form method="POST" action="{{ route('locale.update', ['locale' => $locale === 'fr' ? 'en' : 'fr']) }}">
                        @csrf
                        <button class="button-secondary">{{ $locale === 'fr' ? 'EN' : 'FR' }}</button>
                    </form>
                    @auth
                        <a href="{{ route('dashboard') }}" class="button-primary">{{ __('Dashboard') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="button-primary">{{ __('Login') }}</a>
                    @endauth
                </nav>
            </div>
        </header>

        <main class="public-content">
            @include('partials.flash')
            @yield('content')
        </main>

        <footer class="px-2">
            <div class="surface-panel px-6 py-5">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="font-semibold text-slate-900">TrainUp Academy</p>
                        <p>{{ site_setting('site_tagline') }}</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="tag-chip">{{ site_setting('site_phone') }}</span>
                        <span class="tag-chip">{{ site_setting('admin_email') }}</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
