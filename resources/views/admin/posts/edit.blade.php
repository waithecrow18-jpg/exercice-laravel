@php($title = __('Edit post'))
@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('dashboard.posts.update', $post) }}" class="rounded-3xl bg-white p-6 shadow-sm space-y-6">
        @csrf
        @method('PUT')
        @include('admin.posts.form')
        <button class="rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white">{{ __('Update post') }}</button>
    </form>
@endsection
