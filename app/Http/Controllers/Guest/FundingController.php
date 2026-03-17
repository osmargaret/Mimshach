<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

class FundingController extends Controller
{
    public function index()
    {
        return view('guest.fundings.index');
    }

    public function show($id)
    {
        
    }
}
