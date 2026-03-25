@php($title = __('Create enrollment'))
@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('dashboard.enrollments.store') }}" class="rounded-3xl bg-white p-6 shadow-sm space-y-6">
        @csrf
        @include('admin.enrollments.form')
        <button class="rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white">{{ __('Save enrollment') }}</button>
    </form>
@endsection
