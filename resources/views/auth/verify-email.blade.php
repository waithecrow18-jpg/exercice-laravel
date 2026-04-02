<x-guest-layout>
    <div class="auth-form-meta">
        <span class="eyebrow">{{ __('Email verification') }}</span>
        <h1 class="auth-form-title">{{ __('Confirm your address') }}</h1>
        <p class="auth-form-copy">{{ __('Before getting started, verify your email address using the link we just sent. If you did not receive it, we can send another one.') }}</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="flash-success mb-4">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-6 flex items-center justify-between gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button>
                {{ __('Resend Verification Email') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="underline text-sm">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
