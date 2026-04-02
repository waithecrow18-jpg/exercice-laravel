<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ page_title($title ?? 'Dashboard') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800|plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-shell page-shell">
    <div class="flex min-h-screen">
        <aside class="admin-sidebar hidden w-72 flex-col p-6 lg:flex">
            <div class="space-y-2">
                <span class="eyebrow text-amber-300">{{ __('Operations hub') }}</span>
                <a href="{{ route('dashboard') }}" class="text-2xl font-semibold tracking-tight text-white">TrainUp Admin</a>
                <p class="text-sm text-white/70">{{ __('Bilingual training management dashboard') }}</p>
            </div>

            <nav class="mt-8 space-y-2 text-sm">
                <a class="admin-nav-link {{ request()->routeIs('dashboard') ? 'is-active' : '' }}" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                @can('manage users')
                    <a class="admin-nav-link {{ request()->routeIs('dashboard.users.*') ? 'is-active' : '' }}" href="{{ route('dashboard.users.index') }}">{{ __('Users') }}</a>
                @endcan
                @can('manage categories')
                    <a class="admin-nav-link {{ request()->routeIs('dashboard.categories.*') ? 'is-active' : '' }}" href="{{ route('dashboard.categories.index') }}">{{ __('Categories') }}</a>
                @endcan
                @can('manage trainings')
                    <a class="admin-nav-link {{ request()->routeIs('dashboard.trainings.*') ? 'is-active' : '' }}" href="{{ route('dashboard.trainings.index') }}">{{ __('Trainings') }}</a>
                @endcan
                @can('manage sessions')
                    <a class="admin-nav-link {{ request()->routeIs('dashboard.sessions.*') ? 'is-active' : '' }}" href="{{ route('dashboard.sessions.index') }}">{{ __('Sessions') }}</a>
                @endcan
                @can('manage enrollments')
                    <a class="admin-nav-link {{ request()->routeIs('dashboard.enrollments.*') ? 'is-active' : '' }}" href="{{ route('dashboard.enrollments.index') }}">{{ __('Enrollments') }}</a>
                @endcan
                @can('manage blog')
                    <a class="admin-nav-link {{ request()->routeIs('dashboard.posts.*') ? 'is-active' : '' }}" href="{{ route('dashboard.posts.index') }}">{{ __('Blog') }}</a>
                @endcan
                @can('view reports')
                    <a class="admin-nav-link {{ request()->routeIs('dashboard.messages.*') ? 'is-active' : '' }}" href="{{ route('dashboard.messages.index') }}">{{ __('Messages') }}</a>
                @endcan
            </nav>

            <div class="mt-auto rounded-[1.75rem] border border-white/10 bg-white/10 p-5">
                <p class="text-sm font-semibold text-white">{{ auth()->user()->name }}</p>
                <p class="mt-1 text-xs text-white/70">{{ auth()->user()->email }}</p>
            </div>
        </aside>

        <main class="flex-1 p-4 lg:p-8">
            <div class="admin-frame space-y-6">
                <div class="admin-mobile-nav">
                    <a class="button-secondary {{ request()->routeIs('dashboard') ? '!bg-emerald-100 !text-emerald-800' : '' }}" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                    @can('manage users')
                        <a class="button-secondary {{ request()->routeIs('dashboard.users.*') ? '!bg-emerald-100 !text-emerald-800' : '' }}" href="{{ route('dashboard.users.index') }}">{{ __('Users') }}</a>
                    @endcan
                    @can('manage trainings')
                        <a class="button-secondary {{ request()->routeIs('dashboard.trainings.*') ? '!bg-emerald-100 !text-emerald-800' : '' }}" href="{{ route('dashboard.trainings.index') }}">{{ __('Trainings') }}</a>
                    @endcan
                    @can('manage sessions')
                        <a class="button-secondary {{ request()->routeIs('dashboard.sessions.*') ? '!bg-emerald-100 !text-emerald-800' : '' }}" href="{{ route('dashboard.sessions.index') }}">{{ __('Sessions') }}</a>
                    @endcan
                    @can('manage enrollments')
                        <a class="button-secondary {{ request()->routeIs('dashboard.enrollments.*') ? '!bg-emerald-100 !text-emerald-800' : '' }}" href="{{ route('dashboard.enrollments.index') }}">{{ __('Enrollments') }}</a>
                    @endcan
                </div>

                <header class="admin-header">
                    <div>
                        <span class="eyebrow">{{ __('Control room') }}</span>
                        <h1 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">{{ $title ?? 'Dashboard' }}</h1>
                        <p class="mt-1 text-sm text-slate-500">{{ __('Signed in as') }} {{ auth()->user()->name }}</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ route('public.home', ['locale' => active_locale()]) }}" class="button-secondary">{{ __('View website') }}</a>
                        <a href="{{ route('profile.edit') }}" class="button-secondary">{{ __('Profile') }}</a>
                        <form method="POST" action="{{ route('locale.update', ['locale' => active_locale() === 'fr' ? 'en' : 'fr']) }}">
                            @csrf
                            <button class="button-primary">
                                {{ active_locale() === 'fr' ? 'EN' : 'FR' }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="button-danger">{{ __('Logout') }}</button>
                        </form>
                    </div>
                </header>

                @include('partials.flash')

                <div class="admin-content">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</body>
</html>
