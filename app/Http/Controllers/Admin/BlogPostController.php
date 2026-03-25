<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PublicationStatus;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    public function index(): View
    {
        return view('admin.posts.index', [
            'posts' => BlogPost::query()->with(['category', 'author'])->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.posts.create', [
            'categories' => Category::orderBy('name_fr')->get(),
            'authors' => User::orderBy('name')->get(),
            'statuses' => PublicationStatus::cases(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        BlogPost::create($this->validatePost($request));

        return redirect()->route('dashboard.posts.index')->with('status', __('Post created successfully.'));
    }

    public function edit(BlogPost $post): View
    {
        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => Category::orderBy('name_fr')->get(),
            'authors' => User::orderBy('name')->get(),
            'statuses' => PublicationStatus::cases(),
        ]);
    }

    public function update(Request $request, BlogPost $post): RedirectResponse
    {
        $post->update($this->validatePost($request));

        return redirect()->route('dashboard.posts.index')->with('status', __('Post updated successfully.'));
    }

    public function destroy(Request $request, BlogPost $post)
    {
        $post->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => __('Post deleted successfully.')]);
        }

        return redirect()->route('dashboard.posts.index')->with('status', __('Post deleted successfully.'));
    }

    private function validatePost(Request $request): array
    {
        return $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'author_id' => ['nullable', 'exists:users,id'],
            'title_fr' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'content_fr' => ['required', 'string'],
            'content_en' => ['required', 'string'],
            'status' => ['required', Rule::in(array_map(fn (PublicationStatus $status) => $status->value, PublicationStatus::cases()))],
            'published_at' => ['nullable', 'date'],
            'seo_title_fr' => ['nullable', 'string', 'max:255'],
            'seo_title_en' => ['nullable', 'string', 'max:255'],
            'meta_description_fr' => ['nullable', 'string'],
            'meta_description_en' => ['nullable', 'string'],
        ]);
    }
}
