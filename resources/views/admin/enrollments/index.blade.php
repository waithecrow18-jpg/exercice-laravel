@php($title = __('Enrollments'))
@extends('layouts.admin')

@section('content')
    <section class="rounded-3xl bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold">{{ __('Enrollment management') }}</h2>
            <a href="{{ route('dashboard.enrollments.create') }}" class="rounded-full bg-sky-600 px-5 py-3 text-sm font-semibold text-white">{{ __('Add enrollment') }}</a>
        </div>
        <div class="mt-6 overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="text-left text-slate-500">
                    <tr>
                        <th class="pb-3">{{ __('Reference') }}</th>
                        <th class="pb-3">{{ __('User') }}</th>
                        <th class="pb-3">{{ __('Session') }}</th>
                        <th class="pb-3">{{ __('Status') }}</th>
                        <th class="pb-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($enrollments as $enrollment)
                        <tr data-row>
                            <td class="py-3 font-semibold">{{ $enrollment->reference }}</td>
                            <td class="py-3">{{ $enrollment->user?->name }}</td>
                            <td class="py-3">{{ $enrollment->session?->training?->title_fr }}</td>
                            <td class="py-3">
                                <form action="{{ route('dashboard.enrollments.update', $enrollment) }}" method="POST" data-status-form>
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $enrollment->user_id }}">
                                    <input type="hidden" name="training_session_id" value="{{ $enrollment->training_session_id }}">
                                    <input type="hidden" name="note" value="{{ $enrollment->note }}">
                                    <select name="status" class="rounded-full border border-slate-200 px-3 py-1 text-xs font-semibold {{ status_badge_class($enrollment->status->value) }}">
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->value }}" @selected($enrollment->status->value === $status->value)>{{ $status->label() }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td class="py-3 text-right">
                                <a href="{{ route('dashboard.enrollments.edit', $enrollment) }}" class="mr-2 text-sky-600">{{ __('Edit') }}</a>
                                <button data-ajax-delete data-url="{{ route('dashboard.enrollments.destroy', $enrollment) }}" class="text-rose-600">{{ __('Delete') }}</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $enrollments->links() }}</div>
    </section>
@endsection
