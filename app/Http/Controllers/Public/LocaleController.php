<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function update(Request $request, string $locale): RedirectResponse
    {
        abort_unless(in_array($locale, ['fr', 'en'], true), 404);

        $request->session()->put('locale', $locale);

        if ($request->user()) {
            $request->user()->update(['preferred_locale' => $locale]);
        }

        return back();
    }
}
