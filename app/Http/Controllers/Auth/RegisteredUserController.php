<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['nullable', 'string', 'max:50'],
            'preferred_locale' => ['nullable', 'in:fr,en'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'preferred_locale' => $request->preferred_locale ?? 'fr',
            'status' => UserStatus::Active,
            'password' => Hash::make($request->password),
        ]);

        if (Role::query()->where('name', 'Participant')->exists()) {
            $user->assignRole('Participant');
        }

        event(new Registered($user));

        Auth::login($user);

        $request->session()->put('locale', $user->preferred_locale);

        return redirect(RouteServiceProvider::HOME);
    }
}
