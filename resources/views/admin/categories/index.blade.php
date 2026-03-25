@php($title = __('Categories'))
@extends('layouts.admin')

@section('content')
    <section class="rounded-3xl bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold">{{ __('Category list') }}</h2>
            <a href="{{ route('dashboard.categories.create') }}" class="rounded-full bg-sky-600 px-5 py-3 text-sm font-semibold text-white">{{ __('Add category') }}</a>
        </div>
        <div class="mt-6 overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="text-left text-slate-500">
                    <tr>
                        <th class="pb-3">FR</th>
                        <th class="pb-3">EN</th>
                        <th class="pb-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($categories as $category)
                        <tr data-row>
                            <td class="py-3 font-semibold">{{ $category->name_fr }}</td>
                            <td class="py-3">{{ $category->name_en }}</td>
                            <td class="py-3 text-right">
                                <a href="{{ route('dashboard.categories.edit', $category) }}" class="mr-2 text-sky-600">{{ __('Edit') }}</a>
                                <button data-ajax-delete data-url="{{ route('dashboard.categories.destroy', $category) }}" class="text-rose-600">{{ __('Delete') }}</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $categories->links() }}</div>
    </section>
@endsection
