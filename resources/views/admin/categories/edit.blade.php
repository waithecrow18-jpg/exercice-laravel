@php($title = __('Edit category'))
@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('dashboard.categories.update', $category) }}" class="rounded-3xl bg-white p-6 shadow-sm space-y-6">
        @csrf
        @method('PUT')
        @include('admin.categories.form')
        <button class="rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white">{{ __('Update category') }}</button>
    </form>
@endsection
