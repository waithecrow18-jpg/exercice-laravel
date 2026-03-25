<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PublicationStatus;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Training;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TrainingController extends Controller
{
    public function index(): View
    {
        return view('admin.trainings.index', [
            'trainings' => Training::query()->with('category')->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.trainings.create', [
            'categories' => Category::orderBy('name_fr')->get(),
            'statuses' => PublicationStatus::cases(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateTraining($request);
        $validated['image_path'] = $request->hasFile('image')
            ? $request->file('image')->store('trainings', 'public')
            : null;

        Training::create($validated);

        return redirect()->route('dashboard.trainings.index')->with('status', __('Training created successfully.'));
    }

    public function edit(Training $training): View
    {
        return view('admin.trainings.edit', [
            'training' => $training,
            'categories' => Category::orderBy('name_fr')->get(),
            'statuses' => PublicationStatus::cases(),
        ]);
    }

    public function update(Request $request, Training $training): RedirectResponse
    {
        $validated = $this->validateTraining($request);

        if ($request->hasFile('image')) {
            if ($training->image_path) {
                Storage::disk('public')->delete($training->image_path);
            }

            $validated['image_path'] = $request->file('image')->store('trainings', 'public');
        }

        $training->update($validated);

        return redirect()->route('dashboard.trainings.index')->with('status', __('Training updated successfully.'));
    }

    public function destroy(Request $request, Training $training)
    {
        if ($training->image_path) {
            Storage::disk('public')->delete($training->image_path);
        }

        $training->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => __('Training deleted successfully.')]);
        }

        return redirect()->route('dashboard.trainings.index')->with('status', __('Training deleted successfully.'));
    }

    private function validateTraining(Request $request): array
    {
        return $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title_fr' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'short_description_fr' => ['required', 'string'],
            'short_description_en' => ['required', 'string'],
            'full_description_fr' => ['required', 'string'],
            'full_description_en' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'price' => ['required', 'numeric', 'min:0'],
            'duration_hours' => ['required', 'integer', 'min:1'],
            'level' => ['required', 'string', 'max:100'],
            'status' => ['required', Rule::in(array_map(fn (PublicationStatus $status) => $status->value, PublicationStatus::cases()))],
            'published_at' => ['nullable', 'date'],
            'seo_title_fr' => ['nullable', 'string', 'max:255'],
            'seo_title_en' => ['nullable', 'string', 'max:255'],
            'meta_description_fr' => ['nullable', 'string'],
            'meta_description_en' => ['nullable', 'string'],
        ]);
    }
}
