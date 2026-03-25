@php($title = __('Trainings'))
@extends('layouts.public')

@section('content')
    @php($trainingShowRoute = $locale === 'fr' ? 'public.trainings.show.fr' : 'public.trainings.show.en')
    <section class="rounded-[2rem] bg-white p-8 shadow-sm">
        <h1 class="text-3xl font-black text-slate-900">{{ __('Training catalog') }}</h1>
        <div class="mt-6 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($trainings as $training)
                <article class="rounded-3xl border border-slate-100 bg-slate-50 p-5">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-500">{{ $training->category?->localize('name') }}</p>
                    <h2 class="mt-3 text-xl font-bold">{{ $training->localize('title') }}</h2>
                    <p class="mt-3 text-sm text-slate-600">{{ $training->localize('short_description') }}</p>
                    <div class="mt-5 flex items-center justify-between">
                        <span class="text-sm font-semibold">{{ price_format($training->price) }}</span>
                        <a href="{{ route($trainingShowRoute, ['locale' => $locale, 'slug' => $training->{'slug_'.$locale}]) }}" class="text-sm font-semibold text-sky-600">{{ __('Open') }}</a>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="mt-6">{{ $trainings->links() }}</div>
    </section>
@endsection
