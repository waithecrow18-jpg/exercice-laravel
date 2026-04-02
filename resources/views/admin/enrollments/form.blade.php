@php
    $enrollment = $enrollment ?? null;
    $selectedUser = old('user_id', $enrollment?->user_id);
    $selectedSession = old('training_session_id', $enrollment?->training_session_id);
    $selectedStatus = old('status', data_get($enrollment, 'status.value', 'pending'));
@endphp

<div class="grid gap-5 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-semibold">{{ __('User') }}</label>
        <select name="user_id" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
            @foreach ($users as $userItem)
                <option value="{{ $userItem->id }}" @selected((string) $selectedUser === (string) $userItem->id)>{{ $userItem->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">{{ __('Session') }}</label>
        <select name="training_session_id" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
            @foreach ($sessions as $sessionItem)
                <option value="{{ $sessionItem->id }}" @selected((string) $selectedSession === (string) $sessionItem->id)>{{ $sessionItem->training?->title_fr }} - {{ $sessionItem->starts_at?->format('Y-m-d') }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">{{ __('Status') }}</label>
        <select name="status" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
            @foreach ($statuses as $status)
                <option value="{{ $status->value }}" @selected($selectedStatus === $status->value)>{{ $status->label() }}</option>
            @endforeach
        </select>
    </div>
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-semibold">{{ __('Note') }}</label>
        <textarea name="note" class="w-full rounded-2xl border border-slate-200 px-4 py-3" rows="4">{{ old('note', $enrollment?->note ?? '') }}</textarea>
    </div>
</div>
