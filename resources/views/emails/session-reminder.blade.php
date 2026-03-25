<h1>{{ __('Session reminder') }}</h1>
<p>{{ __('Reminder for your upcoming session') }}: {{ $enrollment->session?->training?->localize('title') }}</p>
<p>{{ $enrollment->session?->starts_at?->format('Y-m-d H:i') }}</p>
