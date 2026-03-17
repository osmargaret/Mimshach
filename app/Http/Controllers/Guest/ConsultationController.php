<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

class ConsultationController extends Controller
{
    public function index()
    {
        return view('guest.consultation');
    }

    public function submit()
    {
        // Handle consultation form submission
    }
}
