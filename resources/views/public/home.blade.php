@php($title = __('Home'))
@extends('layouts.public')

@section('content')
    @php($trainingRoute = $locale === 'fr' ? 'public.trainings.index.fr' : 'public.trainings.index.en')
    @php($trainingShowRoute = $locale === 'fr' ? 'public.trainings.show.fr' : 'public.trainings.show.en')

    <section class="grid gap-6 lg:grid-cols-[1.3fr_0.7fr]">
        <article class="hero-panel p-8">
            <p class="eyebrow text-amber-300">{{ __('Bilingual learning platform') }}</p>
            <h1 class="mt-4 text-4xl font-semibold leading-tight text-white md:text-5xl">{{ site_setting($locale === 'fr' ? 'home_hero_fr' : 'home_hero_en') }}</h1>
            <p class="mt-4 max-w-2xl text-base text-slate-200">{{ __('Manage courses, sessions, enrollments, blog content and SEO from one modern Laravel 10 application.') }}</p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route($trainingRoute, ['locale' => $locale]) }}" class="button-primary">{{ __('Browse trainings') }}</a>
                <a href="{{ route('public.contact', ['locale' => $locale]) }}" class="button-ghost">{{ __('Contact us') }}</a>
            </div>
            <div class="mt-10 grid gap-4 sm:grid-cols-3">
                <div class="rounded-[1.5rem] border border-white/10 bg-white/10 p-4">
                    <p class="text-sm text-white/65">{{ __('Languages') }}</p>
                    <p class="mt-2 text-2xl font-semibold text-white">FR / EN</p>
                </div>
                <div class="rounded-[1.5rem] border border-white/10 bg-white/10 p-4">
                    <p class="text-sm text-white/65">{{ __('Modules') }}</p>
                    <p class="mt-2 text-2xl font-semibold text-white">CRM + CMS</p>
                </div>
                <div class="rounded-[1.5rem] border border-white/10 bg-white/10 p-4">
                    <p class="text-sm text-white/65">{{ __('Audience') }}</p>
                    <p class="mt-2 text-2xl font-semibold text-white">{{ __('Teams & learners') }}</p>
                </div>
            </div>
        </article>
        <article class="surface-panel p-8">
            <p class="eyebrow">{{ __('Why TrainUp') }}</p>
            <h2 class="mt-3 text-3xl font-semibold text-slate-900">{{ __('A polished hub for modern training operations') }}</h2>
            <ul class="mt-6 space-y-4 text-sm leading-6 text-slate-600">
                <li>{{ __('Localized content in French and English for real operational use.') }}</li>
                <li>{{ __('SEO-friendly public pages with clean slugs and structured publishing.') }}</li>
                <li>{{ __('Practical sessions, enrollments, reminders, and reporting in one dashboard.') }}</li>
                <li>{{ __('Role-based access for admins, trainers, and participants.') }}</li>
            </ul>
        </article>
    </section>

    <section class="surface-panel p-8">
        <div class="flex items-center justify-between gap-3">
            <div>
                <p class="eyebrow">{{ __('Programs') }}</p>
                <h2 class="mt-2 text-3xl font-semibold text-slate-900">{{ __('Featured trainings') }}</h2>
            </div>
            <a href="{{ route($trainingRoute, ['locale' => $locale]) }}" class="button-secondary">{{ __('See all') }}</a>
        </div>
        <div class="mt-6 grid gap-5 md:grid-cols-3">
            @foreach ($trainings as $training)
                <article class="catalog-card">
                    <p class="eyebrow">{{ $training->category?->localize('name') }}</p>
                    <h3 class="mt-3 text-2xl font-semibold text-slate-900">{{ $training->localize('title') }}</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $training->localize('short_description') }}</p>
                    <div class="mt-5 flex items-center justify-between gap-3">
                        <span class="tag-chip">{{ price_format($training->price) }}</span>
                        <a href="{{ route($trainingShowRoute, ['locale' => $locale, 'slug' => $training->{'slug_'.$locale}]) }}" class="text-sm font-semibold text-emerald-700">{{ __('Details') }}</a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="surface-panel p-8">
        <div class="flex items-center justify-between gap-3">
            <div>
                <p class="eyebrow">{{ __('Insights') }}</p>
                <h2 class="mt-2 text-3xl font-semibold text-slate-900">{{ __('Latest blog posts') }}</h2>
            </div>
            <a href="{{ route('public.blog.index', ['locale' => $locale]) }}" class="button-secondary">{{ __('See all') }}</a>
        </div>
        <div class="mt-6 grid gap-5 md:grid-cols-3">
            @foreach ($posts as $post)
                <article class="catalog-card">
                    <h3 class="text-xl font-semibold text-slate-900">{{ $post->localize('title') }}</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ \Illuminate\Support\Str::limit($post->localize('content'), 120) }}</p>
                    <a href="{{ route('public.blog.show', ['locale' => $locale, 'slug' => $post->{'slug_'.$locale}]) }}" class="mt-4 inline-flex text-sm font-semibold text-emerald-700">{{ __('Read article') }}</a>
                </article>
            @endforeach
        </div>
    </section>
@endsection
