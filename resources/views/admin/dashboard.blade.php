@php($title = __('Dashboard'))
@extends('layouts.admin')

@section('content')
    <div class="grid gap-4 md:grid-cols-5">
        @foreach ($stats as $label => $value)
            <article class="stat-card">
                <p class="eyebrow">{{ ucfirst($label) }}</p>
                <p class="mt-3 text-4xl font-semibold text-slate-900">{{ $value }}</p>
            </article>
        @endforeach
    </div>

    <section>
        <div class="flex items-center justify-between gap-3">
            <div>
                <p class="eyebrow">{{ __('Recent activity') }}</p>
                <h2 class="mt-2 text-2xl font-semibold text-slate-900">{{ __('Latest enrollments') }}</h2>
            </div>
            <span class="tag-chip">{{ $latestEnrollments->count() }} {{ __('records') }}</span>
        </div>
        <div class="mt-4 overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>{{ __('Reference') }}</th>
                        <th>{{ __('Participant') }}</th>
                        <th>{{ __('Training') }}</th>
                        <th>{{ __('Status') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($latestEnrollments as $enrollment)
                        <tr>
                            <td class="font-semibold">{{ $enrollment->reference }}</td>
                            <td>{{ $enrollment->user?->name }}</td>
                            <td>{{ $enrollment->session?->training?->localize('title') }}</td>
                            <td>
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
