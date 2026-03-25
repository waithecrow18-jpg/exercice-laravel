<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $availableLocales = ['fr', 'en'];
        $requestedLocale = $request->route('locale')
            ?? $request->query('locale')
            ?? $request->session()->get('locale')
            ?? $request->user()?->preferred_locale
            ?? config('app.locale');

        $locale = in_array($requestedLocale, $availableLocales, true)
            ? $requestedLocale
            : config('app.locale', 'fr');

        app()->setLocale($locale);
        $request->session()->put('locale', $locale);

        return $next($request);
    }
}
