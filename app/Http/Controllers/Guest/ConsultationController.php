<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\ConsultationRequest;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function index()
    {
        return view('guest.consultation');
    }

    public function submit(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'education' => 'required|string|in:high_school,bachelor,master,phd,diploma',
            'programmes' => 'required|array|min:1',
            'programmes.*' => 'string',
            'countries' => 'required|array|min:1',
            'countries.*' => 'string',
            'tuition' => 'required|integer|min:0|max:100000',
            'terms' => 'accepted', // Ensure terms checkbox is checked
        ], [
            'terms.accepted' => 'You must agree to the Terms and Conditions and Privacy Policy.',
            'programmes.required' => 'Please select at least one programme of interest.',
            'countries.required' => 'Please select at least one preferred country.',
        ]);

        try {
            // Create the consultation request in database
            $consultation = ConsultationRequest::create([
                'name' => $validated['fullname'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'level_of_education' => $validated['education'],
                'programme_of_interest' => $validated['programmes'],
                'preferred_countries' => $validated['countries'],
                'tuition_budget' => $validated['tuition'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your consultation request has been submitted successfully. We will contact you within 24 hours.',
                'data' => $consultation,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit your request. Please try again later.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }
}
