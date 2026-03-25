<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TrainingResource;
use App\Models\Training;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PublicTrainingController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $trainings = Training::published()->with('category')->paginate(10);

        return TrainingResource::collection($trainings);
    }

    public function show(string $slug): TrainingResource
    {
        $locale = app()->getLocale();

        $training = Training::published()
            ->with(['category', 'sessions.trainer'])
            ->where("slug_{$locale}", $slug)
            ->firstOrFail();

        return TrainingResource::make($training);
    }
}
