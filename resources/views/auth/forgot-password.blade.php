<x-guest-layout>
    <div class="auth-form-meta">
        <span class="eyebrow">{{ __('Account recovery') }}</span>
        <h1 class="auth-form-title">{{ __('Reset your password') }}</h1>
        <p class="auth-form-copy">{{ __('Enter your email address and we will send you a secure link to choose a new password.') }}</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
