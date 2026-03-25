<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsActive
{
    public function handle(Request $request, Closure $next): Response|JsonResponse
    {
        if ($request->user() && $request->user()->status?->value === 'inactive') {
            Auth::logout();

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => __('This account is inactive.'),
                ], 403);
            }

            return redirect()->route('login')->with('status', __('This account is inactive.'));
        }

        return $next($request);
    }
}
