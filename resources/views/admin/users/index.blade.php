@php($title = __('Users'))
@extends('layouts.admin')

@section('content')
    <section class="rounded-3xl bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <input type="text" value="{{ $search }}" placeholder="{{ __('Search users...') }}" data-instant-search data-target="#users-table" class="w-full rounded-2xl border border-slate-200 px-4 py-3 sm:max-w-sm">
            <a href="{{ route('dashboard.users.create') }}" class="rounded-full bg-sky-600 px-5 py-3 text-sm font-semibold text-white">{{ __('Add user') }}</a>
        </div>

        <div class="mt-6 overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="text-left text-slate-500">
                    <tr>
                        <th class="pb-3">{{ __('Name') }}</th>
                        <th class="pb-3">{{ __('Email') }}</th>
                        <th class="pb-3">{{ __('Role') }}</th>
                        <th class="pb-3">{{ __('Language') }}</th>
                        <th class="pb-3">{{ __('Status') }}</th>
                        <th class="pb-3"></th>
                    </tr>
                </thead>
                <tbody id="users-table" class="divide-y divide-slate-100">
                    @foreach ($users as $user)
                        <tr data-row data-search-text="{{ strtolower($user->name.' '.$user->email.' '.$user->phone) }}">
                            <td class="py-3 font-semibold">{{ $user->name }}</td>
                            <td class="py-3">{{ $user->email }}</td>
                            <td class="py-3">{{ $user->roles->pluck('name')->join(', ') }}</td>
                            <td class="py-3 uppercase">{{ $user->preferred_locale }}</td>
                            <td class="py-3">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold {{ status_badge_class($user->status->value) }}">{{ $user->status->label() }}</span>
                            </td>
                            <td class="py-3 text-right">
                                <a href="{{ route('dashboard.users.edit', $user) }}" class="mr-2 text-sky-600">{{ __('Edit') }}</a>
                                <button data-ajax-delete data-url="{{ route('dashboard.users.destroy', $user) }}" class="text-rose-600">{{ __('Delete') }}</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">{{ $users->links() }}</div>
    </section>
@endsection
