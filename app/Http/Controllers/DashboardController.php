<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\ContactMessage;
use App\Models\Enrollment;
use App\Models\Training;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'users' => User::count(),
                'trainings' => Training::count(),
                'enrollments' => Enrollment::count(),
                'posts' => BlogPost::count(),
                'messages' => ContactMessage::count(),
            ],
            'latestEnrollments' => Enrollment::query()
                ->with(['user', 'session.training'])
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
}
