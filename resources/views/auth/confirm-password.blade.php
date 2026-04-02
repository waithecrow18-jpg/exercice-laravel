<x-guest-layout>
    <div class="auth-form-meta">
        <span class="eyebrow">{{ __('Secure area') }}</span>
        <h1 class="auth-form-title">{{ __('Confirm your password') }}</h1>
        <p class="auth-form-copy">{{ __('This area contains sensitive data. Please confirm your password before continuing.') }}</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
