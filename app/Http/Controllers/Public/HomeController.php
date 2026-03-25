<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Training;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(string $locale): View
    {
        return view('public.home', [
            'locale' => $locale,
            'trainings' => Training::published()->with('category')->latest()->take(3)->get(),
            'posts' => BlogPost::published()->latest()->take(3)->get(),
        ]);
    }
}
