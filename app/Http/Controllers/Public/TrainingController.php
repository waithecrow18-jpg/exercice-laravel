<?php

namespace App\Http\Controllers\Public;

use App\Enums\EnrollmentStatus;
use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Training;
use App\Models\TrainingSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrainingController extends Controller
{
    public function index(string $locale): View
    {
        return view('public.trainings.index', [
            'trainings' => Training::published()->with('category')->paginate(9),
            'locale' => $locale,
        ]);
    }

    public function show(string $locale, string $slug): View
    {
        $training = Training::published()
            ->with(['category', 'sessions.trainer'])
            ->where("slug_{$locale}", $slug)
            ->firstOrFail();

        return view('public.trainings.show', [
            'training' => $training,
            'locale' => $locale,
        ]);
    }

    public function sessions(string $locale, string $slug): JsonResponse
    {
        $training = Training::published()->where("slug_{$locale}", $slug)->firstOrFail();

        $sessions = $training->sessions()
            ->with('trainer')
            ->where('starts_at', '>=', now())
            ->orderBy('starts_at')
            ->get()
            ->map(fn (TrainingSession $session) => [
                'id' => $session->id,
                'starts_at' => $session->starts_at?->format('Y-m-d H:i'),
                'ends_at' => $session->ends_at?->format('Y-m-d H:i'),
                'mode' => $session->mode?->label(),
                'city' => $session->city,
                'trainer' => $session->trainer?->name,
                'remaining_seats' => $session->remainingSeats(),
            ]);

        return response()->json(['sessions' => $sessions]);
    }

    public function enroll(Request $request, TrainingSession $session): RedirectResponse|JsonResponse
    {
        $enrollment = Enrollment::firstOrCreate(
            [
                'user_id' => $request->user()->id,
                'training_session_id' => $session->id,
            ],
            [
                'status' => EnrollmentStatus::Pending->value,
            ]
        );

        if ($request->expectsJson()) {
            return response()->json([
                'message' => __('Enrollment request sent successfully.'),
                'reference' => $enrollment->reference,
            ]);
        }

        return back()->with('status', __('Enrollment request sent successfully.'));
    }
}
