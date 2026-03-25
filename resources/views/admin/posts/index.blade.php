@php($title = __('Blog posts'))
@extends('layouts.admin')

@section('content')
    <section class="rounded-3xl bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold">{{ __('Blog management') }}</h2>
            <a href="{{ route('dashboard.posts.create') }}" class="rounded-full bg-sky-600 px-5 py-3 text-sm font-semibold text-white">{{ __('Add post') }}</a>
        </div>
        <div class="mt-6 overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="text-left text-slate-500">
                    <tr>
                        <th class="pb-3">{{ __('Title') }}</th>
                        <th class="pb-3">{{ __('Author') }}</th>
                        <th class="pb-3">{{ __('Status') }}</th>
                        <th class="pb-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($posts as $post)
                        <tr data-row>
                            <td class="py-3 font-semibold">{{ $post->title_fr }}</td>
                            <td class="py-3">{{ $post->author?->name }}</td>
                            <td class="py-3"><span class="rounded-full px-3 py-1 text-xs font-semibold {{ status_badge_class($post->status->value) }}">{{ $post->status->label() }}</span></td>
                            <td class="py-3 text-right">
                                <a href="{{ route('dashboard.posts.edit', $post) }}" class="mr-2 text-sky-600">{{ __('Edit') }}</a>
                                <button data-ajax-delete data-url="{{ route('dashboard.posts.destroy', $post) }}" class="text-rose-600">{{ __('Delete') }}</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $posts->links() }}</div>
    </section>
@endsection
