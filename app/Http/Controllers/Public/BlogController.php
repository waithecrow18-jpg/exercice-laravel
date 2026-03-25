<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(string $locale): View
    {
        return view('public.blog.index', [
            'posts' => BlogPost::published()->latest()->paginate(6),
            'locale' => $locale,
        ]);
    }

    public function show(string $locale, string $slug): View
    {
        $post = BlogPost::published()->where("slug_{$locale}", $slug)->firstOrFail();

        return view('public.blog.show', [
            'post' => $post,
            'locale' => $locale,
        ]);
    }
}
