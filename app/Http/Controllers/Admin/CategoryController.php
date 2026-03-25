<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.categories.index', [
            'categories' => Category::latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name_fr' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
        ]);

        Category::create($validated);

        return redirect()->route('dashboard.categories.index')->with('status', __('Category created successfully.'));
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name_fr' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
        ]);

        $category->update($validated);

        return redirect()->route('dashboard.categories.index')->with('status', __('Category updated successfully.'));
    }

    public function destroy(Request $request, Category $category)
    {
        $category->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => __('Category deleted successfully.')]);
        }

        return redirect()->route('dashboard.categories.index')->with('status', __('Category deleted successfully.'));
    }
}
