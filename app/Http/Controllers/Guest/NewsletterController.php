<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscription;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        // Create or update the newsletter subscription
        NewsletterSubscription::updateOrCreate(
            ['email' => $request->email],
            ['subscribed_at' => now()]
        );

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for subscribing to our newsletter!',
            ]);
        }

        return back()->with('newsletter_success', 'Thank you for subscribing to our newsletter!');
    }
}
