@php($title = __('Contact'))
@extends('layouts.public')

@section('content')
    <section class="grid gap-6 lg:grid-cols-[0.8fr_1.2fr]">
        <article class="rounded-[2rem] bg-slate-900 p-8 text-white shadow-xl">
            <p class="text-sm uppercase tracking-[0.2em] text-sky-200">{{ __('Need help?') }}</p>
            <h1 class="mt-3 text-4xl font-black">{{ __('Contact our team') }}</h1>
            <p class="mt-4 text-slate-300">{{ __('Use the AJAX contact form to send your request directly to the administrator and keep a trace in the database.') }}</p>
        </article>
        <form action="{{ route('public.contact.store', ['locale' => $locale]) }}" method="POST" data-ajax-contact class="rounded-[2rem] bg-white p-8 shadow-sm space-y-4">
            @csrf
            <div class="grid gap-4 md:grid-cols-2">
                <input type="text" name="full_name" placeholder="{{ __('Full name') }}" class="rounded-2xl border border-slate-200 px-4 py-3">
                <input type="email" name="email" placeholder="{{ __('Email') }}" class="rounded-2xl border border-slate-200 px-4 py-3">
                <input type="text" name="phone" placeholder="{{ __('Phone') }}" class="rounded-2xl border border-slate-200 px-4 py-3 md:col-span-2">
                <input type="text" name="subject" placeholder="{{ __('Subject') }}" class="rounded-2xl border border-slate-200 px-4 py-3 md:col-span-2">
                <textarea name="message" rows="6" placeholder="{{ __('Message') }}" class="rounded-2xl border border-slate-200 px-4 py-3 md:col-span-2"></textarea>
            </div>
            <p data-contact-notice class="hidden rounded-2xl bg-emerald-50 px-4 py-3 text-sm text-emerald-700"></p>
            <button class="rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white">{{ __('Send message') }}</button>
        </form>
    </section>
@endsection
