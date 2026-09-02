<?php

use App\Models\Blog;
use App\Models\User;

test('guest can view blogs index with blog cards and images', function () {
    $author = User::factory()->create(['name' => 'Jane Scholar']);

    $blog = Blog::create([
        'user_id' => $author->id,
        'title' => 'Top 10 Scholarships for International Students',
        'subtitle' => 'A comprehensive guide for 2026',
        'content' => 'Scholarship content goes here in detail...',
        'featured_image' => 'blogs/scholarships.jpg',
    ]);

    $response = $this->get(route('blogs.index'));

    $response->assertOk();
    $response->assertViewIs('guest.blog.index');
    $response->assertSee('Top 10 Scholarships for International Students');
    $response->assertSee('A comprehensive guide for 2026');
    $response->assertSee($blog->featured_image_url);
});

test('guest can view blog article page with hero background image', function () {
    $author = User::factory()->create(['name' => 'Jane Scholar']);

    $blog = Blog::create([
        'user_id' => $author->id,
        'title' => 'Visa Application Tips and Tricks',
        'subtitle' => 'Step by step visa processing guide',
        'content' => 'Full article content describing visa steps...',
        'featured_image' => 'blogs/visa-guide.jpg',
    ]);

    $response = $this->get(route('blogs.article', $blog));

    $response->assertOk();
    $response->assertViewIs('guest.blog.article');
    $response->assertSee('Visa Application Tips and Tricks');
    $response->assertSee('Step by step visa processing guide');
    $response->assertSee('Jane Scholar');
    $response->assertSee($blog->featured_image_url);
});
