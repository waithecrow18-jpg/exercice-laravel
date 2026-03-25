@php($title = __('Create category'))
@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('dashboard.categories.store') }}" class="rounded-3xl bg-white p-6 shadow-sm space-y-6">
        @csrf
        @include('admin.categories.form')
        <button class="rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white">{{ __('Save category') }}</button>
    </form>
@endsection
