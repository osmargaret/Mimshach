<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

class UniversityController extends Controller
{
    public function index()
    {
        return view('guest.universities.index');
    }

    public function show($id)
    {
        
    }
}
