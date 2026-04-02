<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessageReceivedMail;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function create(string $locale): View
    {
        return view('public.contact', compact('locale'));
    }

    public function store(Request $request, string $locale): JsonResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        $message = ContactMessage::create([
            ...$validated,
            'locale' => $locale,
        ]);

        Mail::to(site_setting('admin_email', 'salma.bennani@trainup.ma'))
            ->send(new ContactMessageReceivedMail($message));

        return response()->json([
            'message' => __('Your message has been sent successfully.'),
        ]);
    }
}
