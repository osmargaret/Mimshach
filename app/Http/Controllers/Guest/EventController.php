<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index()
    {
        return view('guest.events.index');
    }

    public function show($id) {}
}
