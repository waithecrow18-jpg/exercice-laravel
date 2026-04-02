@php($title = $training->seoTitle($locale))
@php($metaDescription = $training->seoDescription($locale))
@extends('layouts.public')

@section('content')
    @php($sessionsRoute = $locale === 'fr' ? 'public.trainings.sessions.fr' : 'public.trainings.sessions.en')
    <section class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
        <article class="surface-panel p-8">
            <p class="eyebrow">{{ $training->category?->localize('name') }}</p>
            <h1 class="mt-3 text-4xl font-semibold text-slate-900">{{ $training->localize('title') }}</h1>
            <p class="mt-4 text-lg text-slate-600">{{ $training->localize('short_description') }}</p>
            <div class="mt-6 flex flex-wrap gap-3 text-sm">
                <span class="tag-chip">{{ price_format($training->price) }}</span>
                <span class="tag-chip">{{ $training->duration_hours }}h</span>
                <span class="tag-chip">{{ $training->level }}</span>
            </div>
            <div class="prose mt-6 max-w-none text-slate-700">
                <p>{{ $training->localize('full_description') }}</p>
            </div>
        </article>

        <aside class="space-y-6">
            <section class="surface-panel p-6">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="eyebrow">{{ __('Sessions') }}</p>
                        <h2 class="mt-2 text-2xl font-semibold">{{ __('Upcoming sessions') }}</h2>
                    </div>
                    <button type="button" data-load-sessions data-target="#dynamic-sessions" data-url="{{ route($sessionsRoute, ['locale' => $locale, 'slug' => $training->{'slug_'.$locale}]) }}" class="button-secondary">{{ __('Refresh') }}</button>
                </div>
                <div id="dynamic-sessions" class="mt-4 space-y-3">
                    @foreach ($training->sessions as $session)
                        <div class="catalog-card !p-4">
                            <p class="font-semibold">{{ $session->starts_at?->format('Y-m-d H:i') }}</p>
                            <p class="mt-1 text-sm text-slate-600">{{ $session->mode->label() }} {{ $session->city ? '- '.$session->city : '' }}</p>
                            <p class="text-sm text-slate-600">{{ $session->trainer?->name }}</p>
                            @auth
                                <form method="POST" action="{{ route('public.enrollments.store', $session) }}" class="mt-3">
                                    @csrf
                                    <button class="button-primary">{{ __('Enroll') }}</button>
                                </form>
                            @endauth
                        </div>
                    @endforeach
                </div>
            </section>
        </aside>
    </section>
@endsection
