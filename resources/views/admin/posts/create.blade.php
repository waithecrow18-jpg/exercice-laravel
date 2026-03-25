@php($title = __('Create post'))
@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('dashboard.posts.store') }}" class="rounded-3xl bg-white p-6 shadow-sm space-y-6">
        @csrf
        @include('admin.posts.form')
        <button class="rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white">{{ __('Save post') }}</button>
    </form>
@endsection
