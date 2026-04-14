<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('updated_at', 'desc')->paginate(6);

        return view('guest.blog.index', compact('blogs'));
    }

    public function show(Blog $article)
    {
        $recentBlogs = Blog::where('id', '!=', $article->id)
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

        return view('guest.blog.article', compact('article', 'recentBlogs'));
    }
}
