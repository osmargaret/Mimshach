<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

class AdmissionController extends Controller
{
    public function index()
    {
        return view('guest.admissions.index');
    }

    public function show($id)
    {
        // Implementation for showing a specific admission
        return 'We have opened for another session';
    }
}
