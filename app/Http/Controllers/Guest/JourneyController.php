<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

class JourneyController extends Controller
{
    public function index()
    {
        return view('guest.journey');
    }

    public function submit()
    {
        // Handle journey form submission
    }
}