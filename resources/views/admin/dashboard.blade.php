@php($title = __('Dashboard'))
@extends('layouts.admin')

@section('content')
    <section class="grid gap-4 md:grid-cols-5">
        @foreach ($stats as $label => $value)
            <article class="rounded-3xl bg-white p-6 shadow-sm">
                <p class="text-sm uppercase tracking-[0.2em] text-slate-500">{{ ucfirst($label) }}</p>
                <p class="mt-3 text-4xl font-black text-slate-900">{{ $value }}</p>
            </article>
        @endforeach
    </section>

    <section class="rounded-3xl bg-white p-6 shadow-sm">
        <h2 class="text-xl font-bold text-slate-900">{{ __('Latest enrollments') }}</h2>
        <div class="mt-4 overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="text-left text-slate-500">
                    <tr>
                        <th class="pb-3">{{ __('Reference') }}</th>
                        <th class="pb-3">{{ __('Participant') }}</th>
                        <th class="pb-3">{{ __('Training') }}</th>
                        <th class="pb-3">{{ __('Status') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($latestEnrollments as $enrollment)
                        <tr>
                            <td class="py-3 font-semibold">{{ $enrollment->reference }}</td>
                            <td class="py-3">{{ $enrollment->user?->name }}</td>
                            <td class="py-3">{{ $enrollment->session?->training?->localize('title') }}</td>
                            <td class="py-3">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold {{ status_badge_class($enrollment->status->value) }}">
                                    {{ $enrollment->status->label() }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
