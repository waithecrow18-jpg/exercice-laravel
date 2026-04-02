@props(['active'])

@php
$classes = ($active ?? false)
            ? 'nav-pill is-active'
            : 'nav-pill';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
