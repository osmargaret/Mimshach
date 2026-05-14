<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscription;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $email = $validated['email'];

        $existingSubscription = NewsletterSubscription::where(
            'email',
            $email
        )->first();

        if ($existingSubscription) {

            $existingSubscription->update([
                'subscribed_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Welcome back! Your subscription has been renewed.'
            ]);
        }

        NewsletterSubscription::create([
            'email' => $email,
            'subscribed_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing to our newsletter!'
        ]);
    }
}
