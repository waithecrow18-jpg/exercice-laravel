@php($title = $training->seoTitle($locale))
@php($metaDescription = $training->seoDescription($locale))
@extends('layouts.public')

@section('content')
    @php($sessionsRoute = $locale === 'fr' ? 'public.trainings.sessions.fr' : 'public.trainings.sessions.en')
    <section class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
        <article class="rounded-[2rem] bg-white p-8 shadow-sm">
            <p class="text-sm uppercase tracking-[0.2em] text-slate-500">{{ $training->category?->localize('name') }}</p>
            <h1 class="mt-3 text-4xl font-black text-slate-900">{{ $training->localize('title') }}</h1>
            <p class="mt-4 text-lg text-slate-600">{{ $training->localize('short_description') }}</p>
            <div class="mt-6 flex flex-wrap gap-3 text-sm">
                <span class="rounded-full bg-sky-50 px-4 py-2 font-semibold text-sky-700">{{ price_format($training->price) }}</span>
                <span class="rounded-full bg-slate-100 px-4 py-2 font-semibold text-slate-700">{{ $training->duration_hours }}h</span>
                <span class="rounded-full bg-slate-100 px-4 py-2 font-semibold text-slate-700">{{ $training->level }}</span>
            </div>
            <div class="prose mt-6 max-w-none text-slate-700">
                <p>{{ $training->localize('full_description') }}</p>
            </div>
        </article>

        <aside class="space-y-6">
            <section class="rounded-[2rem] bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold">{{ __('Upcoming sessions') }}</h2>
                    <button type="button" data-load-sessions data-target="#dynamic-sessions" data-url="{{ route($sessionsRoute, ['locale' => $locale, 'slug' => $training->{'slug_'.$locale}]) }}" class="text-sm font-semibold text-sky-600">{{ __('Refresh') }}</button>
                </div>
                <div id="dynamic-sessions" class="mt-4 space-y-3">
                    @foreach ($training->sessions as $session)
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="font-semibold">{{ $session->starts_at?->format('Y-m-d H:i') }}</p>
                            <p class="text-sm text-slate-600">{{ $session->mode->label() }} {{ $session->city ? '• '.$session->city : '' }}</p>
                            <p class="text-sm text-slate-600">{{ $session->trainer?->name }}</p>
                            @auth
                                <form method="POST" action="{{ route('public.enrollments.store', $session) }}" class="mt-3">
                                    @csrf
                                    <button class="rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white">{{ __('Enroll') }}</button>
                                </form>
                            @endauth
                        </div>
                    @endforeach
                </div>
            </section>
        </aside>
    </section>
@endsection
