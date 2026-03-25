<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SessionMode;
use App\Enums\SessionStatus;
use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TrainingSessionController extends Controller
{
    public function index(): View
    {
        return view('admin.sessions.index', [
            'sessions' => TrainingSession::query()
                ->with(['training', 'trainer'])
                ->latest('starts_at')
                ->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.sessions.create', [
            'trainings' => Training::orderBy('title_fr')->get(),
            'trainers' => User::orderBy('name')->get(),
            'modes' => SessionMode::cases(),
            'statuses' => SessionStatus::cases(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        TrainingSession::create($this->validateSession($request));

        return redirect()->route('dashboard.sessions.index')->with('status', __('Session created successfully.'));
    }

    public function edit(TrainingSession $session): View
    {
        return view('admin.sessions.edit', [
            'session' => $session,
            'trainings' => Training::orderBy('title_fr')->get(),
            'trainers' => User::orderBy('name')->get(),
            'modes' => SessionMode::cases(),
            'statuses' => SessionStatus::cases(),
        ]);
    }

    public function update(Request $request, TrainingSession $session): RedirectResponse
    {
        $session->update($this->validateSession($request));

        return redirect()->route('dashboard.sessions.index')->with('status', __('Session updated successfully.'));
    }

    public function destroy(Request $request, TrainingSession $session)
    {
        $session->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => __('Session deleted successfully.')]);
        }

        return redirect()->route('dashboard.sessions.index')->with('status', __('Session deleted successfully.'));
    }

    private function validateSession(Request $request): array
    {
        return $request->validate([
            'training_id' => ['required', 'exists:trainings,id'],
            'trainer_id' => ['nullable', 'exists:users,id'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date', 'after:starts_at'],
            'capacity' => ['required', 'integer', 'min:1'],
            'mode' => ['required', Rule::in(array_map(fn (SessionMode $mode) => $mode->value, SessionMode::cases()))],
            'city' => ['nullable', 'string', 'max:255'],
            'meeting_link' => ['nullable', 'url'],
            'status' => ['required', Rule::in(array_map(fn (SessionStatus $status) => $status->value, SessionStatus::cases()))],
        ]);
    }
}
