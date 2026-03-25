@php($title = __('Sessions'))
@extends('layouts.admin')

@section('content')
    <section class="rounded-3xl bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold">{{ __('Session calendar') }}</h2>
            <a href="{{ route('dashboard.sessions.create') }}" class="rounded-full bg-sky-600 px-5 py-3 text-sm font-semibold text-white">{{ __('Add session') }}</a>
        </div>
        <div class="mt-6 overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="text-left text-slate-500">
                    <tr>
                        <th class="pb-3">{{ __('Training') }}</th>
                        <th class="pb-3">{{ __('Trainer') }}</th>
                        <th class="pb-3">{{ __('Start') }}</th>
                        <th class="pb-3">{{ __('Mode') }}</th>
                        <th class="pb-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($sessions as $session)
                        <tr data-row>
                            <td class="py-3 font-semibold">{{ $session->training?->title_fr }}</td>
                            <td class="py-3">{{ $session->trainer?->name }}</td>
                            <td class="py-3">{{ $session->starts_at?->format('Y-m-d H:i') }}</td>
                            <td class="py-3">{{ $session->mode->label() }}</td>
                            <td class="py-3 text-right">
                                <a href="{{ route('dashboard.sessions.edit', $session) }}" class="mr-2 text-sky-600">{{ __('Edit') }}</a>
                                <button data-ajax-delete data-url="{{ route('dashboard.sessions.destroy', $session) }}" class="text-rose-600">{{ __('Delete') }}</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $sessions->links() }}</div>
    </section>
@endsection
