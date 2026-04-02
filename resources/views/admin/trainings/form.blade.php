@php
    $training = $training ?? null;
    $selectedCategory = old('category_id', $training?->category_id);
    $selectedStatus = old('status', data_get($training, 'status.value', 'draft'));
    $publishedAt = old('published_at', $training?->published_at?->format('Y-m-d\TH:i') ?? '');
@endphp

<div class="grid gap-5 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-semibold">{{ __('Category') }}</label>
        <select name="category_id" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected((string) $selectedCategory === (string) $category->id)>{{ $category->name_fr }}</option>
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
    <div>
        <label class="mb-2 block text-sm font-semibold">Titre FR</label>
        <input type="text" name="title_fr" value="{{ old('title_fr', $training?->title_fr ?? '') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3" required>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">Title EN</label>
        <input type="text" name="title_en" value="{{ old('title_en', $training?->title_en ?? '') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3" required>
    </div>
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-semibold">Description courte FR</label>
        <textarea name="short_description_fr" class="w-full rounded-2xl border border-slate-200 px-4 py-3" rows="3">{{ old('short_description_fr', $training?->short_description_fr ?? '') }}</textarea>
    </div>
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-semibold">Short description EN</label>
        <textarea name="short_description_en" class="w-full rounded-2xl border border-slate-200 px-4 py-3" rows="3">{{ old('short_description_en', $training?->short_description_en ?? '') }}</textarea>
    </div>
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-semibold">Description complete FR</label>
        <textarea name="full_description_fr" class="w-full rounded-2xl border border-slate-200 px-4 py-3" rows="6">{{ old('full_description_fr', $training?->full_description_fr ?? '') }}</textarea>
    </div>
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-semibold">Full description EN</label>
        <textarea name="full_description_en" class="w-full rounded-2xl border border-slate-200 px-4 py-3" rows="6">{{ old('full_description_en', $training?->full_description_en ?? '') }}</textarea>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">{{ __('Price') }}</label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $training?->price ?? '') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">{{ __('Duration hours') }}</label>
        <input type="number" name="duration_hours" value="{{ old('duration_hours', $training?->duration_hours ?? '') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">{{ __('Level') }}</label>
        <input type="text" name="level" value="{{ old('level', $training?->level ?? '') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">{{ __('Publication date') }}</label>
        <input type="datetime-local" name="published_at" value="{{ $publishedAt }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
    </div>
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-semibold">{{ __('Image') }}</label>
        <input type="file" name="image" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">SEO title FR</label>
        <input type="text" name="seo_title_fr" value="{{ old('seo_title_fr', $training?->seo_title_fr ?? '') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">SEO title EN</label>
        <input type="text" name="seo_title_en" value="{{ old('seo_title_en', $training?->seo_title_en ?? '') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
    </div>
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-semibold">Meta description FR</label>
        <textarea name="meta_description_fr" rows="3" class="w-full rounded-2xl border border-slate-200 px-4 py-3">{{ old('meta_description_fr', $training?->meta_description_fr ?? '') }}</textarea>
    </div>
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-semibold">Meta description EN</label>
        <textarea name="meta_description_en" rows="3" class="w-full rounded-2xl border border-slate-200 px-4 py-3">{{ old('meta_description_en', $training?->meta_description_en ?? '') }}</textarea>
    </div>
</div>
