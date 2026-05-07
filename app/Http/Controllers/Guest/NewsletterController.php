<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscription;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'email' => 'required|email|max:255',
            ]);

            $email = $request->email;
            $existingSubscription = NewsletterSubscription::where('email', $email)->first();

            if ($existingSubscription) {
                // Update the subscription date
                $existingSubscription->update(['subscribed_at' => now()]);

                return response()->json([
                    'success' => true,
                    'message' => 'Welcome back! Your subscription has been renewed.',
                ], 200);
            }

            // Create new subscription
            NewsletterSubscription::create([
                'email' => $email,
                'subscribed_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for subscribing to our newsletter!',
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Please provide a valid email address.',
            ], 422);
        }
    }
}
