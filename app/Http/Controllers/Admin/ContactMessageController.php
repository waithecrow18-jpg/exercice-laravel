<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(): View
    {
        return view('admin.messages.index', [
            'messages' => ContactMessage::latest()->paginate(10),
        ]);
    }

    public function show(ContactMessage $message): View
    {
        $message->update(['read_at' => $message->read_at ?? now()]);

        return view('admin.messages.show', compact('message'));
    }

    public function destroy(Request $request, ContactMessage $message)
    {
        $message->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => __('Message deleted successfully.')]);
        }

        return redirect()->route('dashboard.messages.index')->with('status', __('Message deleted successfully.'));
    }
}
