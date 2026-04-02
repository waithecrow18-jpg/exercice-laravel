@php($category = $category ?? null)

<div class="grid gap-5 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-semibold">{{ __('French name') }}</label>
        <input type="text" name="name_fr" value="{{ old('name_fr', $category?->name_fr ?? '') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">{{ __('English name') }}</label>
        <input type="text" name="name_en" value="{{ old('name_en', $category?->name_en ?? '') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3" required>
    </div>
</div>
