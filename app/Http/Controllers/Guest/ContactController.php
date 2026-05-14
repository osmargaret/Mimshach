<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Notifications\ContactFormReceivedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function index()
    {
        return view('guest.contact');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {

            Notification::route('mail', config('mail.admin_email'))
                ->notify(new ContactFormReceivedNotification($validated));

            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully!',
            ]);
        } catch (\Exception $e) {

            report($e);

            return response()->json([
                'success' => false,
                'message' => 'There was an error sending your message. Please try again later.'
            ], 500);
        }
    }
}
