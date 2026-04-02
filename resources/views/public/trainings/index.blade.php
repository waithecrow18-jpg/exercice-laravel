@php($title = __('Trainings'))
@extends('layouts.public')

@section('content')
    @php($trainingShowRoute = $locale === 'fr' ? 'public.trainings.show.fr' : 'public.trainings.show.en')
    <section class="surface-panel p-8">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="eyebrow">{{ __('Training catalog') }}</p>
                <h1 class="mt-2 text-4xl font-semibold text-slate-900">{{ __('Explore our learning programs') }}</h1>
            </div>
            <span class="tag-chip">{{ $trainings->total() }} {{ __('results') }}</span>
        </div>
        <div class="mt-6 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($trainings as $training)
                <article class="catalog-card">
                    <p class="eyebrow">{{ $training->category?->localize('name') }}</p>
                    <h2 class="mt-3 text-2xl font-semibold">{{ $training->localize('title') }}</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $training->localize('short_description') }}</p>
                    <div class="mt-5 flex items-center justify-between gap-3">
                        <span class="tag-chip">{{ price_format($training->price) }}</span>
                        <a href="{{ route($trainingShowRoute, ['locale' => $locale, 'slug' => $training->{'slug_'.$locale}]) }}" class="text-sm font-semibold text-emerald-700">{{ __('Open') }}</a>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="mt-6">{{ $trainings->links() }}</div>
    </section>
@endsection
