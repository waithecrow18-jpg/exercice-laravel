@php
    $session = $session ?? null;
    $selectedTraining = old('training_id', $session?->training_id);
    $selectedTrainer = old('trainer_id', $session?->trainer_id);
    $selectedMode = old('mode', data_get($session, 'mode.value', ''));
    $selectedStatus = old('status', data_get($session, 'status.value', 'scheduled'));
    $startsAt = old('starts_at', $session?->starts_at?->format('Y-m-d\TH:i') ?? '');
    $endsAt = old('ends_at', $session?->ends_at?->format('Y-m-d\TH:i') ?? '');
@endphp

<div class="grid gap-5 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-semibold">{{ __('Training') }}</label>
        <select name="training_id" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
            @foreach ($trainings as $trainingItem)
                <option value="{{ $trainingItem->id }}" @selected((string) $selectedTraining === (string) $trainingItem->id)>{{ $trainingItem->title_fr }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">{{ __('Trainer') }}</label>
        <select name="trainer_id" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
            <option value="">{{ __('Select a trainer') }}</option>
            @foreach ($trainers as $trainer)
                <option value="{{ $trainer->id }}" @selected((string) $selectedTrainer === (string) $trainer->id)>{{ $trainer->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">{{ __('Start date') }}</label>
        <input type="datetime-local" name="starts_at" value="{{ $startsAt }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">{{ __('End date') }}</label>
        <input type="datetime-local" name="ends_at" value="{{ $endsAt }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">{{ __('Capacity') }}</label>
        <input type="number" name="capacity" value="{{ old('capacity', $session?->capacity ?? '') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">{{ __('Mode') }}</label>
        <select name="mode" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
            @foreach ($modes as $mode)
                <option value="{{ $mode->value }}" @selected($selectedMode === $mode->value)>{{ $mode->label() }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">{{ __('City') }}</label>
        <input type="text" name="city" value="{{ old('city', $session?->city ?? '') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">{{ __('Meeting link') }}</label>
        <input type="url" name="meeting_link" value="{{ old('meeting_link', $session?->meeting_link ?? '') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">{{ __('Status') }}</label>
        <select name="status" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
            @foreach ($statuses as $status)
                <option value="{{ $status->value }}" @selected($selectedStatus === $status->value)>{{ $status->label() }}</option>
            @endforeach
        </select>
    </div>
</div>
