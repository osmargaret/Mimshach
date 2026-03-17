<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        return view('guest.blog.index');
    }

    public function show($article) {}
}
