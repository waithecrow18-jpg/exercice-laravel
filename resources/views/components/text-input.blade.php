@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-2xl border-slate-200 px-4 py-3 shadow-sm focus:border-emerald-600 focus:ring-emerald-600']) !!}>
