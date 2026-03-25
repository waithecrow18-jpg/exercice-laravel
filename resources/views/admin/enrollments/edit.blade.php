@php($title = __('Edit enrollment'))
@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('dashboard.enrollments.update', $enrollment) }}" class="rounded-3xl bg-white p-6 shadow-sm space-y-6">
        @csrf
        @method('PUT')
        @include('admin.enrollments.form')
        <button class="rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white">{{ __('Update enrollment') }}</button>
    </form>
@endsection
