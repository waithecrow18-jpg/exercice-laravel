@php($title = __('Edit user'))
@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('dashboard.users.update', $user) }}" class="rounded-3xl bg-white p-6 shadow-sm space-y-6">
        @csrf
        @method('PUT')
        @include('admin.users.form')
        <button class="rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white">{{ __('Update user') }}</button>
    </form>
@endsection
