@php($title = __('Blog'))
@extends('layouts.public')

@section('content')
    <section class="rounded-[2rem] bg-white p-8 shadow-sm">
        <h1 class="text-3xl font-black text-slate-900">{{ __('Training blog') }}</h1>
        <div class="mt-6 grid gap-5 md:grid-cols-2">
            @foreach ($posts as $post)
                <article class="rounded-3xl border border-slate-100 bg-slate-50 p-6">
                    <h2 class="text-2xl font-black text-slate-900">{{ $post->localize('title') }}</h2>
                    <p class="mt-4 text-sm text-slate-600">{{ \Illuminate\Support\Str::limit($post->localize('content'), 180) }}</p>
                    <a href="{{ route('public.blog.show', ['locale' => $locale, 'slug' => $post->{'slug_'.$locale}]) }}" class="mt-5 inline-flex text-sm font-semibold text-sky-600">{{ __('Read more') }}</a>
                </article>
            @endforeach
        </div>
        <div class="mt-6">{{ $posts->links() }}</div>
    </section>
@endsection
