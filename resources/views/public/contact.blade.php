@php($title = __('Contact'))
@extends('layouts.public')

@section('content')
    <section class="grid gap-6 lg:grid-cols-[0.8fr_1.2fr]">
        <article class="hero-panel p-8">
            <p class="eyebrow text-amber-300">{{ __('Need help?') }}</p>
            <h1 class="mt-3 text-4xl font-semibold text-white">{{ __('Contact our team') }}</h1>
            <p class="mt-4 text-slate-200">{{ __('Use the AJAX contact form to send your request directly to the administrator and keep a trace in the database.') }}</p>
            <div class="mt-8 space-y-3 text-sm text-white/78">
                <p>{{ site_setting('admin_email') }}</p>
                <p>{{ site_setting('site_phone') }}</p>
            </div>
        </article>
        <form action="{{ route('public.contact.store', ['locale' => $locale]) }}" method="POST" data-ajax-contact class="surface-panel p-8 space-y-4">
            @csrf
            <div class="grid gap-4 md:grid-cols-2">
                <input type="text" name="full_name" placeholder="{{ __('Full name') }}" class="px-4 py-3">
                <input type="email" name="email" placeholder="{{ __('Email') }}" class="px-4 py-3">
                <input type="text" name="phone" placeholder="{{ __('Phone') }}" class="px-4 py-3 md:col-span-2">
                <input type="text" name="subject" placeholder="{{ __('Subject') }}" class="px-4 py-3 md:col-span-2">
                <textarea name="message" rows="6" placeholder="{{ __('Message') }}" class="px-4 py-3 md:col-span-2"></textarea>
            </div>
            <p data-contact-notice class="hidden rounded-2xl bg-emerald-50 px-4 py-3 text-sm text-emerald-700"></p>
            <button class="button-primary">{{ __('Send message') }}</button>
        </form>
    </section>
@endsection
