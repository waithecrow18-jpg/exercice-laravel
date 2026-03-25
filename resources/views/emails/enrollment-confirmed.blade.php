<h1>{{ __('Enrollment confirmed') }}</h1>
<p>{{ __('Your enrollment reference is') }} {{ $enrollment->reference }}.</p>
<p>{{ $enrollment->session?->training?->localize('title') }}</p>
