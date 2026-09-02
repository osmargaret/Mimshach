<?php

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('admin can create a blog post with subtitle and featured image', function () {
    Storage::fake('public');

    $admin = User::factory()->create([
        'role' => 'super_admin',
    ]);

    $image = UploadedFile::fake()->image('test-post.jpg', 600, 400);

    $response = $this->actingAs($admin)->postJson(route('admin.blogs.store'), [
        'title' => 'My New Blog Post',
        'subtitle' => 'An insightful subtitle for the post',
        'content' => 'Full article content goes here.',
        'featured_image' => $image,
    ]);

    $response->assertOk();
    $response->assertJson(['success' => true]);

    $this->assertDatabaseHas('blogs', [
        'title' => 'My New Blog Post',
        'subtitle' => 'An insightful subtitle for the post',
        'content' => 'Full article content goes here.',
        'user_id' => $admin->id,
    ]);

    $blog = Blog::where('title', 'My New Blog Post')->first();
    expect($blog->featured_image)->not->toBeNull();
    Storage::disk('public')->assertExists($blog->featured_image);
    expect($blog->featured_image_url)->toContain('/storage/');
});

test('admin can update a blog post including subtitle and featured image', function () {
    Storage::fake('public');

    $admin = User::factory()->create([
        'role' => 'super_admin',
    ]);

    $oldImage = UploadedFile::fake()->image('old-post.jpg', 600, 400);
    $oldPath = $oldImage->store('blogs', 'public');

    $blog = Blog::create([
        'user_id' => $admin->id,
        'title' => 'Original Title',
        'subtitle' => 'Original Subtitle',
        'content' => 'Original content',
        'featured_image' => $oldPath,
    ]);

    $newImage = UploadedFile::fake()->image('new-post.jpg', 800, 600);

    $response = $this->actingAs($admin)->putJson(route('admin.blogs.update', $blog->id), [
        'title' => 'Updated Title',
        'subtitle' => 'Updated Subtitle Value',
        'content' => 'Updated content goes here.',
        'featured_image' => $newImage,
    ]);

    $response->assertOk();
    $response->assertJson(['success' => true]);

    $blog->refresh();
    expect($blog->title)->toBe('Updated Title');
    expect($blog->subtitle)->toBe('Updated Subtitle Value');
    expect($blog->content)->toBe('Updated content goes here.');
    expect($blog->featured_image)->not->toBe($oldPath);
    Storage::disk('public')->assertMissing($oldPath);
    Storage::disk('public')->assertExists($blog->featured_image);
    expect($blog->featured_image_url)->toContain('/storage/');
});

test('admin can update a blog post without changing existing image', function () {
    Storage::fake('public');

    $admin = User::factory()->create([
        'role' => 'super_admin',
    ]);

    $image = UploadedFile::fake()->image('existing-post.jpg', 600, 400);
    $existingPath = $image->store('blogs', 'public');

    $blog = Blog::create([
        'user_id' => $admin->id,
        'title' => 'Original Title',
        'subtitle' => 'Old Subtitle',
        'content' => 'Original content',
        'featured_image' => $existingPath,
    ]);

    $response = $this->actingAs($admin)->putJson(route('admin.blogs.update', $blog->id), [
        'title' => 'New Title',
        'subtitle' => 'New Subtitle Here',
        'content' => 'Updated content',
    ]);

    $response->assertOk();
    $response->assertJson(['success' => true]);

    $blog->refresh();
    expect($blog->subtitle)->toBe('New Subtitle Here');
    expect($blog->featured_image)->toBe($existingPath);
    Storage::disk('public')->assertExists($existingPath);
});

test('admin can fetch blog edit data with featured_image_url and subtitle', function () {
    $admin = User::factory()->create([
        'role' => 'super_admin',
    ]);

    $blog = Blog::create([
        'user_id' => $admin->id,
        'title' => 'Test Blog for Edit',
        'subtitle' => 'Test Subtitle for Edit',
        'content' => 'Some content',
        'featured_image' => 'blogs/sample.jpg',
    ]);

    $response = $this->actingAs($admin)->getJson(route('admin.blogs.edit', $blog->id));

    $response->assertOk();
    $response->assertJsonPath('blog.title', 'Test Blog for Edit');
    $response->assertJsonPath('blog.subtitle', 'Test Subtitle for Edit');
    $response->assertJsonPath('blog.featured_image_url', asset('storage/blogs/sample.jpg'));
});
