<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $filters = [
            [
                'type' => 'date',
                'name' => 'date_from',
                'placeholder' => 'Blogs From',
            ],
            [
                'type' => 'date',
                'name' => 'date_to',
                'placeholder' => 'Blogs To',
            ],
            [
                'type' => 'date',
                'name' => 'specific_date',
                'placeholder' => 'Specific Date',
            ],
            [
                'type' => 'search',
                'name' => 'search',
                'placeholder' => 'Search blogs...',
            ],
        ];

        $query = Blog::with('user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%'.$search.'%')
                    ->orWhere('subtitle', 'like', '%'.$search.'%')
                    ->orWhere('content', 'like', '%'.$search.'%');
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        if ($request->filled('specific_date')) {
            $query->whereDate('created_at', $request->specific_date);
        }

        $blogs = $query->orderBy('id', 'desc')->paginate(6);

        return view('admin.blogs.index', compact('blogs', 'filters'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'nullable|string',
                'content' => 'required|string',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            $validated['user_id'] = auth()->id();

            // Handle featured image upload
            if ($request->hasFile('featured_image') && $request->file('featured_image')->isValid()) {
                try {
                    $imagePath = $request->file('featured_image')->store('blogs', 'public');
                    $validated['featured_image'] = $imagePath;
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to upload image: '.$e->getMessage(),
                    ], 500);
                }
            }

            $blog = Blog::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Blog post created successfully',
                'blog' => $blog,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Blog store error: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error creating blog post: '.$e->getMessage(),
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $blog = Blog::with('user')->findOrFail($id);

            return response()->json([
                'success' => true,
                'blog' => $blog,
            ]);
        } catch (\Exception $e) {
            Log::error('Blog edit error: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Blog post not found',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $blog = Blog::findOrFail($id);

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'nullable|string',
                'content' => 'required|string',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            // Handle featured image upload
            if ($request->hasFile('featured_image') && $request->file('featured_image')->isValid()) {
                // Delete old image if exists locally
                if ($blog->featured_image && ! str_starts_with($blog->featured_image, 'http') && Storage::disk('public')->exists($blog->featured_image)) {
                    Storage::disk('public')->delete($blog->featured_image);
                }

                $imagePath = $request->file('featured_image')->store('blogs', 'public');
                $validated['featured_image'] = $imagePath;
            }

            $blog->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Blog post updated successfully',
                'blog' => $blog->fresh(),
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Blog update error: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error updating blog post: '.$e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $blog = Blog::findOrFail($id);

            // Delete featured image if exists
            if ($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)) {
                Storage::disk('public')->delete($blog->featured_image);
            }

            $blog->delete();

            return response()->json([
                'success' => true,
                'message' => 'Blog post deleted successfully',
            ]);
        } catch (\Exception $e) {
            Log::error('Blog delete error: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error deleting blog post: '.$e->getMessage(),
            ], 500);
        }
    }
}
