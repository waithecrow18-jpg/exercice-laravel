@php($title = __('Create training'))
@extends('layouts.admin')

@section('content')
    <form method="POST" enctype="multipart/form-data" action="{{ route('dashboard.trainings.store') }}" class="rounded-3xl bg-white p-6 shadow-sm space-y-6">
        @csrf
        @include('admin.trainings.form')
        <button class="rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white">{{ __('Save training') }}</button>
    </form>
@endsection
