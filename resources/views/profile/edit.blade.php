<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <span class="eyebrow">{{ __('Account settings') }}</span>
            <h2 class="text-3xl font-semibold leading-tight text-slate-900">
                {{ __('Profile') }}
            </h2>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="profile-card">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="profile-card">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="profile-card">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
