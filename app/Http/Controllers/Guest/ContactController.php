<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Notifications\ContactFormReceivedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        return view('guest.contact');
    }

    public function submit(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        try {
            Notification::route('mail', config('mail.admin_email'))
                ->notify(new ContactFormReceivedNotification($validator->validated()));

               return response()->json([
                    'success' => true,
                    'message' => 'Your message has been sent successfully!',
                ]);

        } catch (\Exception $e) {
            report($e);

            return response()->json([
                    'success' => false,
                    'message' => 'There was an error sending your message. Please try again later.',
                ], 500);
        }
    }
}
