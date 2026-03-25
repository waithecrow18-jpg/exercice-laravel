@php($title = $post->seoTitle($locale))
@php($metaDescription = $post->seoDescription($locale))
@extends('layouts.public')

@section('content')
    <article class="rounded-[2rem] bg-white p-8 shadow-sm">
        <p class="text-xs uppercase tracking-[0.2em] text-slate-500">{{ $post->published_at?->format('Y-m-d') }}</p>
        <h1 class="mt-3 text-4xl font-black text-slate-900">{{ $post->localize('title') }}</h1>
        <div class="prose mt-6 max-w-none text-slate-700">
            <p>{{ $post->localize('content') }}</p>
        </div>
    </article>
@endsection
