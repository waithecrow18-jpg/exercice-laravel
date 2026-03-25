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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[radial-gradient(circle_at_top,_#e0f2fe,_#f8fafc_45%)]">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <header class="rounded-[2rem] border border-sky-100 bg-white/90 px-6 py-5 shadow-sm backdrop-blur">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <a href="{{ route('public.home', ['locale' => $locale]) }}" class="text-2xl font-black tracking-tight text-slate-900">TrainUp Academy</a>
                    <p class="text-sm text-slate-500">{{ site_setting('site_tagline') }}</p>
                </div>
                <nav class="flex flex-wrap items-center gap-3 text-sm font-medium text-slate-700">
                    <a href="{{ route('public.home', ['locale' => $locale]) }}" class="rounded-full px-4 py-2 hover:bg-sky-50">{{ __('Home') }}</a>
                    <a href="{{ route($trainingIndexRoute, ['locale' => $locale]) }}" class="rounded-full px-4 py-2 hover:bg-sky-50">{{ __('Trainings') }}</a>
                    <a href="{{ route('public.blog.index', ['locale' => $locale]) }}" class="rounded-full px-4 py-2 hover:bg-sky-50">{{ __('Blog') }}</a>
                    <a href="{{ route('public.contact', ['locale' => $locale]) }}" class="rounded-full px-4 py-2 hover:bg-sky-50">{{ __('Contact') }}</a>
                    <form method="POST" action="{{ route('locale.update', ['locale' => $locale === 'fr' ? 'en' : 'fr']) }}">
                        @csrf
                        <button class="rounded-full border border-slate-200 px-4 py-2">{{ $locale === 'fr' ? 'EN' : 'FR' }}</button>
                    </form>
                    @auth
                        <a href="{{ route('dashboard') }}" class="rounded-full bg-slate-900 px-4 py-2 text-white">{{ __('Dashboard') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-full bg-slate-900 px-4 py-2 text-white">{{ __('Login') }}</a>
                    @endauth
                </nav>
            </div>
        </header>

        <main class="mt-8 space-y-6">
            @include('partials.flash')
            @yield('content')
        </main>
    </div>
</body>
</html>
