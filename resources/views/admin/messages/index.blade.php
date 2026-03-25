@php($title = __('Contact messages'))
@extends('layouts.admin')

@section('content')
    <section class="rounded-3xl bg-white p-6 shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="text-left text-slate-500">
                    <tr>
                        <th class="pb-3">{{ __('Name') }}</th>
                        <th class="pb-3">{{ __('Subject') }}</th>
                        <th class="pb-3">{{ __('Received') }}</th>
                        <th class="pb-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($messages as $message)
                        <tr data-row>
                            <td class="py-3 font-semibold">{{ $message->full_name }}</td>
                            <td class="py-3">{{ $message->subject }}</td>
                            <td class="py-3">{{ $message->created_at->format('Y-m-d H:i') }}</td>
                            <td class="py-3 text-right">
                                <a href="{{ route('dashboard.messages.show', $message) }}" class="mr-2 text-sky-600">{{ __('Open') }}</a>
                                <button data-ajax-delete data-url="{{ route('dashboard.messages.destroy', $message) }}" class="text-rose-600">{{ __('Delete') }}</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $messages->links() }}</div>
    </section>
@endsection
