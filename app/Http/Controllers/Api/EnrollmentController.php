<?php

namespace App\Http\Controllers\Api;

use App\Enums\EnrollmentStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\EnrollmentResource;
use App\Models\Enrollment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\Rule;

class EnrollmentController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $enrollments = $request->user()
            ->enrollments()
            ->with(['session.training'])
            ->latest()
            ->paginate(10);

        return EnrollmentResource::collection($enrollments);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'training_session_id' => [
                'required',
                'exists:training_sessions,id',
                Rule::unique('enrollments')->where(fn ($query) => $query->where('user_id', $request->user()->id)),
            ],
        ]);

        $enrollment = Enrollment::create([
            'user_id' => $request->user()->id,
            'training_session_id' => $validated['training_session_id'],
            'status' => EnrollmentStatus::Pending->value,
        ]);

        return response()->json([
            'message' => __('Enrollment created successfully.'),
            'data' => EnrollmentResource::make($enrollment->load('session.training')),
        ], 201);
    }
}
