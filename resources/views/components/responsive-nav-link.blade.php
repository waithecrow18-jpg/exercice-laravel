@props(['active'])

@php
$classes = ($active ?? false)
            ? 'mx-2 block rounded-2xl bg-emerald-50 px-4 py-3 text-start text-base font-medium text-emerald-800'
            : 'mx-2 block rounded-2xl px-4 py-3 text-start text-base font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
