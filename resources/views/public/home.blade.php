@php($title = __('Home'))
@extends('layouts.public')

@section('content')
    @php($trainingRoute = $locale === 'fr' ? 'public.trainings.index.fr' : 'public.trainings.index.en')
    @php($trainingShowRoute = $locale === 'fr' ? 'public.trainings.show.fr' : 'public.trainings.show.en')

    <section class="grid gap-6 lg:grid-cols-[1.3fr_0.7fr]">
        <article class="rounded-[2rem] bg-slate-900 p-8 text-white shadow-xl">
            <p class="text-xs uppercase tracking-[0.3em] text-sky-200">{{ __('Bilingual learning platform') }}</p>
            <h1 class="mt-4 text-4xl font-black leading-tight">{{ site_setting($locale === 'fr' ? 'home_hero_fr' : 'home_hero_en') }}</h1>
            <p class="mt-4 max-w-2xl text-slate-300">{{ __('Manage courses, sessions, enrollments, blog content and SEO from one modern Laravel 10 application.') }}</p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route($trainingRoute, ['locale' => $locale]) }}" class="rounded-full bg-sky-400 px-5 py-3 text-sm font-bold text-slate-900">{{ __('Browse trainings') }}</a>
                <a href="{{ route('public.contact', ['locale' => $locale]) }}" class="rounded-full border border-slate-700 px-5 py-3 text-sm font-semibold">{{ __('Contact us') }}</a>
            </div>
        </article>
        <article class="rounded-[2rem] border border-sky-100 bg-white p-8 shadow-sm">
            <p class="text-sm uppercase tracking-[0.2em] text-slate-500">{{ __('Why TrainUp') }}</p>
            <ul class="mt-6 space-y-4 text-sm text-slate-700">
                <li>{{ __('Localized content in French and English') }}</li>
                <li>{{ __('SEO-friendly public pages with clean slugs') }}</li>
                <li>{{ __('Practical sessions with enrollments and reminders') }}</li>
                <li>{{ __('Role-based dashboard for your team') }}</li>
            </ul>
        </article>
    </section>

    <section class="rounded-[2rem] bg-white p-8 shadow-sm">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-black text-slate-900">{{ __('Featured trainings') }}</h2>
            <a href="{{ route($trainingRoute, ['locale' => $locale]) }}" class="text-sm font-semibold text-sky-600">{{ __('See all') }}</a>
        </div>
        <div class="mt-6 grid gap-5 md:grid-cols-3">
            @foreach ($trainings as $training)
                <article class="rounded-3xl border border-slate-100 bg-slate-50 p-5">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-500">{{ $training->category?->localize('name') }}</p>
                    <h3 class="mt-3 text-xl font-bold text-slate-900">{{ $training->localize('title') }}</h3>
                    <p class="mt-3 text-sm text-slate-600">{{ $training->localize('short_description') }}</p>
                    <div class="mt-5 flex items-center justify-between">
                        <span class="text-sm font-semibold text-slate-900">{{ price_format($training->price) }}</span>
                        <a href="{{ route($trainingShowRoute, ['locale' => $locale, 'slug' => $training->{'slug_'.$locale}]) }}" class="text-sm font-semibold text-sky-600">{{ __('Details') }}</a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="rounded-[2rem] bg-white p-8 shadow-sm">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-black text-slate-900">{{ __('Latest blog posts') }}</h2>
            <a href="{{ route('public.blog.index', ['locale' => $locale]) }}" class="text-sm font-semibold text-sky-600">{{ __('See all') }}</a>
        </div>
        <div class="mt-6 grid gap-5 md:grid-cols-3">
            @foreach ($posts as $post)
                <article class="rounded-3xl border border-slate-100 bg-slate-50 p-5">
                    <h3 class="text-lg font-bold">{{ $post->localize('title') }}</h3>
                    <p class="mt-3 text-sm text-slate-600">{{ \Illuminate\Support\Str::limit($post->localize('content'), 120) }}</p>
                    <a href="{{ route('public.blog.show', ['locale' => $locale, 'slug' => $post->{'slug_'.$locale}]) }}" class="mt-4 inline-flex text-sm font-semibold text-sky-600">{{ __('Read article') }}</a>
                </article>
            @endforeach
        </div>
    </section>
@endsection
