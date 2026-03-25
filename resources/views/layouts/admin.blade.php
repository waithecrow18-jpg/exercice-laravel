<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ page_title($title ?? 'Dashboard') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100">
    <div class="flex min-h-screen">
        <aside class="hidden w-72 flex-col border-r border-slate-200 bg-white p-6 lg:flex">
            <a href="{{ route('dashboard') }}" class="text-xl font-black tracking-tight text-slate-900">TrainUp Admin</a>
            <p class="mt-2 text-sm text-slate-500">{{ __('Bilingual training management dashboard') }}</p>

            <nav class="mt-8 space-y-2 text-sm">
                <a class="block rounded-xl px-4 py-3 hover:bg-slate-100" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                @can('manage users')
                    <a class="block rounded-xl px-4 py-3 hover:bg-slate-100" href="{{ route('dashboard.users.index') }}">{{ __('Users') }}</a>
                @endcan
                @can('manage categories')
                    <a class="block rounded-xl px-4 py-3 hover:bg-slate-100" href="{{ route('dashboard.categories.index') }}">{{ __('Categories') }}</a>
                @endcan
                @can('manage trainings')
                    <a class="block rounded-xl px-4 py-3 hover:bg-slate-100" href="{{ route('dashboard.trainings.index') }}">{{ __('Trainings') }}</a>
                @endcan
                @can('manage sessions')
                    <a class="block rounded-xl px-4 py-3 hover:bg-slate-100" href="{{ route('dashboard.sessions.index') }}">{{ __('Sessions') }}</a>
                @endcan
                @can('manage enrollments')
                    <a class="block rounded-xl px-4 py-3 hover:bg-slate-100" href="{{ route('dashboard.enrollments.index') }}">{{ __('Enrollments') }}</a>
                @endcan
                @can('manage blog')
                    <a class="block rounded-xl px-4 py-3 hover:bg-slate-100" href="{{ route('dashboard.posts.index') }}">{{ __('Blog') }}</a>
                @endcan
                @can('view reports')
                    <a class="block rounded-xl px-4 py-3 hover:bg-slate-100" href="{{ route('dashboard.messages.index') }}">{{ __('Messages') }}</a>
                @endcan
            </nav>
        </aside>

        <main class="flex-1 p-4 lg:p-8">
            <div class="mx-auto max-w-7xl space-y-6">
                <header class="flex flex-col gap-4 rounded-3xl bg-white p-6 shadow-sm sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl font-black tracking-tight text-slate-900">{{ $title ?? 'Dashboard' }}</h1>
                        <p class="mt-1 text-sm text-slate-500">{{ __('Signed in as') }} {{ auth()->user()->name }}</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ route('public.home', ['locale' => active_locale()]) }}" class="rounded-full border border-slate-200 px-4 py-2 text-sm font-medium">{{ __('View website') }}</a>
                        <a href="{{ route('profile.edit') }}" class="rounded-full border border-slate-200 px-4 py-2 text-sm font-medium">{{ __('Profile') }}</a>
                        <form method="POST" action="{{ route('locale.update', ['locale' => active_locale() === 'fr' ? 'en' : 'fr']) }}">
                            @csrf
                            <button class="rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white">
                                {{ active_locale() === 'fr' ? 'EN' : 'FR' }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="rounded-full bg-rose-600 px-4 py-2 text-sm font-semibold text-white">{{ __('Logout') }}</button>
                        </form>
                    </div>
                </header>

                @include('partials.flash')

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
