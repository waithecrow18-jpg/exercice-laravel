<div class="grid gap-5 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">{{ __('Name') }}</label>
        <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">{{ __('Email') }}</label>
        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">{{ __('Phone') }}</label>
        <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">{{ __('Language') }}</label>
        <select name="preferred_locale" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
            <option value="fr" @selected(old('preferred_locale', $user->preferred_locale ?? 'fr') === 'fr')>Francais</option>
            <option value="en" @selected(old('preferred_locale', $user->preferred_locale ?? 'fr') === 'en')>English</option>
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">{{ __('Role') }}</label>
        <select name="role" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
            @foreach ($roles as $role)
                <option value="{{ $role }}" @selected(old('role', $user->roles->first()->name ?? '') === $role)>{{ $role }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">{{ __('Status') }}</label>
        <select name="status" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
            @foreach ($statuses as $status)
                <option value="{{ $status->value }}" @selected(old('status', $user->status->value ?? 'active') === $status->value)>{{ $status->label() }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">{{ __('Password') }}</label>
        <input type="password" name="password" class="w-full rounded-2xl border border-slate-200 px-4 py-3" {{ isset($user) ? '' : 'required' }}>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold text-slate-700">{{ __('Confirm password') }}</label>
        <input type="password" name="password_confirmation" class="w-full rounded-2xl border border-slate-200 px-4 py-3" {{ isset($user) ? '' : 'required' }}>
    </div>
</div>
