<div class="grid gap-5 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-semibold">{{ __('Category') }}</label>
        <select name="category_id" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
            <option value="">{{ __('None') }}</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id ?? '') == $category->id)>{{ $category->name_fr }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">{{ __('Author') }}</label>
        <select name="author_id" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
            <option value="">{{ __('None') }}</option>
            @foreach ($authors as $author)
                <option value="{{ $author->id }}" @selected(old('author_id', $post->author_id ?? auth()->id()) == $author->id)>{{ $author->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">{{ __('Status') }}</label>
        <select name="status" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
            @foreach ($statuses as $status)
                <option value="{{ $status->value }}" @selected(old('status', $post->status->value ?? 'draft') === $status->value)>{{ $status->label() }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">{{ __('Publication date') }}</label>
        <input type="datetime-local" name="published_at" value="{{ old('published_at', isset($post) && $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">Titre FR</label>
        <input type="text" name="title_fr" value="{{ old('title_fr', $post->title_fr ?? '') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">Title EN</label>
        <input type="text" name="title_en" value="{{ old('title_en', $post->title_en ?? '') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
    </div>
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-semibold">Contenu FR</label>
        <textarea name="content_fr" rows="6" class="w-full rounded-2xl border border-slate-200 px-4 py-3">{{ old('content_fr', $post->content_fr ?? '') }}</textarea>
    </div>
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-semibold">Content EN</label>
        <textarea name="content_en" rows="6" class="w-full rounded-2xl border border-slate-200 px-4 py-3">{{ old('content_en', $post->content_en ?? '') }}</textarea>
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">SEO title FR</label>
        <input type="text" name="seo_title_fr" value="{{ old('seo_title_fr', $post->seo_title_fr ?? '') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
    </div>
    <div>
        <label class="mb-2 block text-sm font-semibold">SEO title EN</label>
        <input type="text" name="seo_title_en" value="{{ old('seo_title_en', $post->seo_title_en ?? '') }}" class="w-full rounded-2xl border border-slate-200 px-4 py-3">
    </div>
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-semibold">Meta description FR</label>
        <textarea name="meta_description_fr" rows="3" class="w-full rounded-2xl border border-slate-200 px-4 py-3">{{ old('meta_description_fr', $post->meta_description_fr ?? '') }}</textarea>
    </div>
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-semibold">Meta description EN</label>
        <textarea name="meta_description_en" rows="3" class="w-full rounded-2xl border border-slate-200 px-4 py-3">{{ old('meta_description_en', $post->meta_description_en ?? '') }}</textarea>
    </div>
</div>
