@php($title = __('Blog'))
@extends('layouts.public')

@section('content')
    <section class="surface-panel p-8">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="eyebrow">{{ __('Knowledge hub') }}</p>
                <h1 class="mt-2 text-4xl font-semibold text-slate-900">{{ __('Training blog') }}</h1>
            </div>
            <span class="tag-chip">{{ $posts->total() }} {{ __('articles') }}</span>
        </div>
        <div class="mt-6 grid gap-5 md:grid-cols-2">
            @foreach ($posts as $post)
                <article class="catalog-card">
                    <p class="eyebrow">{{ $post->published_at?->format('Y-m-d') }}</p>
                    <h2 class="mt-3 text-2xl font-semibold text-slate-900">{{ $post->localize('title') }}</h2>
                    <p class="mt-4 text-sm leading-6 text-slate-600">{{ \Illuminate\Support\Str::limit($post->localize('content'), 180) }}</p>
                    <a href="{{ route('public.blog.show', ['locale' => $locale, 'slug' => $post->{'slug_'.$locale}]) }}" class="mt-5 inline-flex text-sm font-semibold text-emerald-700">{{ __('Read more') }}</a>
                </article>
            @endforeach
        </div>
        <div class="mt-6">{{ $posts->links() }}</div>
    </section>
@endsection
