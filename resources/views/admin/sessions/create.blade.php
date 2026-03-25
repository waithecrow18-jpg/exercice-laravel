@php($title = __('Create session'))
@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('dashboard.sessions.store') }}" class="rounded-3xl bg-white p-6 shadow-sm space-y-6">
        @csrf
        @include('admin.sessions.form')
        <button class="rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white">{{ __('Save session') }}</button>
    </form>
@endsection
