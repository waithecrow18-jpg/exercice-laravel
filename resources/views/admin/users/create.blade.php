@php($title = __('Create user'))
@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('dashboard.users.store') }}" class="rounded-3xl bg-white p-6 shadow-sm space-y-6">
        @csrf
        @include('admin.users.form')
        <button class="rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white">{{ __('Save user') }}</button>
    </form>
@endsection
