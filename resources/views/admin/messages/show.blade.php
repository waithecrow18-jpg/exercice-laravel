@php($title = __('Message detail'))
@extends('layouts.admin')

@section('content')
    <article class="rounded-3xl bg-white p-6 shadow-sm space-y-4">
        <h2 class="text-2xl font-black">{{ $message->subject }}</h2>
        <p class="text-sm text-slate-500">{{ $message->full_name }} - {{ $message->email }}</p>
        <p class="text-sm text-slate-500">{{ $message->phone }}</p>
        <div class="rounded-2xl bg-slate-50 p-4 text-slate-700">
            {{ $message->message }}
        </div>
    </article>
@endsection
