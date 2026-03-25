@php($title = __('Edit training'))
@extends('layouts.admin')

@section('content')
    <form method="POST" enctype="multipart/form-data" action="{{ route('dashboard.trainings.update', $training) }}" class="rounded-3xl bg-white p-6 shadow-sm space-y-6">
        @csrf
        @method('PUT')
        @include('admin.trainings.form')
        <button class="rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white">{{ __('Update training') }}</button>
    </form>
@endsection
