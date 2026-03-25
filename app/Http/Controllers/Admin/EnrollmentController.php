<?php

namespace App\Http\Controllers\Admin;

use App\Enums\EnrollmentStatus;
use App\Http\Controllers\Controller;
use App\Mail\EnrollmentCancelledMail;
use App\Mail\EnrollmentConfirmedMail;
use App\Models\Enrollment;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EnrollmentController extends Controller
{
    public function index(): View
    {
        return view('admin.enrollments.index', [
            'enrollments' => Enrollment::query()
                ->with(['user', 'session.training'])
                ->latest()
                ->paginate(10),
            'statuses' => EnrollmentStatus::cases(),
        ]);
    }

    public function create(): View
    {
        return view('admin.enrollments.create', [
            'users' => User::orderBy('name')->get(),
            'sessions' => TrainingSession::with('training')->orderBy('starts_at')->get(),
            'statuses' => EnrollmentStatus::cases(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateEnrollment($request);
        $enrollment = Enrollment::create($validated);
        $this->applyStatus($enrollment, $validated['status']);

        return redirect()->route('dashboard.enrollments.index')->with('status', __('Enrollment created successfully.'));
    }

    public function edit(Enrollment $enrollment): View
    {
        return view('admin.enrollments.edit', [
            'enrollment' => $enrollment,
            'users' => User::orderBy('name')->get(),
            'sessions' => TrainingSession::with('training')->orderBy('starts_at')->get(),
            'statuses' => EnrollmentStatus::cases(),
        ]);
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $validated = $this->validateEnrollment($request, $enrollment);
        $enrollment->update($validated);
        $this->applyStatus($enrollment, $validated['status']);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => __('Enrollment updated successfully.'),
                'status' => $enrollment->status?->value,
            ]);
        }

        return redirect()->route('dashboard.enrollments.index')->with('status', __('Enrollment updated successfully.'));
    }

    public function destroy(Request $request, Enrollment $enrollment)
    {
        $enrollment->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => __('Enrollment deleted successfully.')]);
        }

        return redirect()->route('dashboard.enrollments.index')->with('status', __('Enrollment deleted successfully.'));
    }

    public function secureStatus(Request $request, string $encryptedId, string $status): RedirectResponse
    {
        $enrollment = Enrollment::findOrFail(Crypt::decryptString(urldecode($encryptedId)));
        $this->applyStatus($enrollment, $status);

        return redirect()->route('dashboard.enrollments.index')->with('status', __('Enrollment status updated securely.'));
    }

    private function validateEnrollment(Request $request, ?Enrollment $enrollment = null): array
    {
        $uniqueRule = Rule::unique('enrollments')
            ->where(fn ($query) => $query->where('training_session_id', $request->training_session_id))
            ->ignore($enrollment?->id);

        return $request->validate([
            'user_id' => ['required', 'exists:users,id', $uniqueRule],
            'training_session_id' => ['required', 'exists:training_sessions,id'],
            'status' => ['required', Rule::in(array_map(fn (EnrollmentStatus $status) => $status->value, EnrollmentStatus::cases()))],
            'note' => ['nullable', 'string'],
        ]);
    }

    private function applyStatus(Enrollment $enrollment, string $status): void
    {
        if ($status === EnrollmentStatus::Confirmed->value) {
            $enrollment->forceFill([
                'status' => $status,
                'confirmed_at' => now(),
                'cancelled_at' => null,
            ])->save();

            Mail::to($enrollment->user->email)->send(new EnrollmentConfirmedMail($enrollment->fresh('session.training', 'user')));
        }

        if ($status === EnrollmentStatus::Cancelled->value) {
            $enrollment->forceFill([
                'status' => $status,
                'cancelled_at' => now(),
            ])->save();

            Mail::to($enrollment->user->email)->send(new EnrollmentCancelledMail($enrollment->fresh('session.training', 'user')));
        }
    }
}
