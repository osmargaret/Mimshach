<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Changed from Auth::guard('admin')->user()
        $admins = $user->isSuperAdmin() ? User::whereIn('role', ['admin', 'super_admin'])->get() : collect();

        return view('admin.settings.index', compact('user', 'admins'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user(); // Changed from Auth::guard('admin')->user()

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id), // Using 'users' table
            ],
        ]);

        $user->update($request->only('name', 'email'));

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully!'
        ]);
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user(); // Changed from Auth::guard('admin')->user()

        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect.'
            ], 422);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully!'
        ]);
    }

    public function createAdmin(Request $request)
    {
        $this->checkSuperAdmin();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Using 'users' table
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,super_admin',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => true,
            'phone' => $request->phone ?? null, // Added phone field
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Admin created successfully!',
            'user' => $user
        ]);
    }

    public function updateAdmin(Request $request, User $user)
    {
        $this->checkSuperAdmin();

        // Prevent self-demotion
        if ($user->id === Auth::id() && $request->has('role')) { // Changed from Auth::guard('admin')->id()
            return response()->json([
                'success' => false,
                'message' => 'You cannot change your own role.'
            ], 422);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id), // Using 'users' table
            ],
            'role' => 'sometimes|required|in:admin,super_admin',
            'is_active' => 'sometimes|boolean',
        ]);

        $updateData = $request->only('name', 'email');

        if ($request->has('role')) {
            $updateData['role'] = $request->role;
        }

        if ($request->has('is_active')) {
            $updateData['is_active'] = $request->is_active;
        }

        $user->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'Admin updated successfully!',
            'user' => $user
        ]);
    }

    public function deleteAdmin(User $user)
    {
        $this->checkSuperAdmin();

        // Prevent deleting yourself
        if ($user->id === Auth::id()) { // Changed from Auth::guard('admin')->id()
            return response()->json([
                'success' => false,
                'message' => 'You cannot delete your own account.'
            ], 422);
        }

        $user->delete(true);

        return response()->json([
            'success' => true,
            'message' => 'Admin deleted successfully!'
        ]);
    }

    public function editAdmin(User $user)
    {
        $this->checkSuperAdmin();

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'is_active' => $user->is_active,
        ]);
    }

    private function checkSuperAdmin()
    {
        if (!Auth::user()->isSuperAdmin()) { // Changed from Auth::guard('admin')->user()
            abort(403, 'Unauthorized action.');
        }
    }

    public function getSiteSettings()
    {
        return response()->json([
            'success' => true,
            'settings' => SiteSetting::getAll()
        ]);
    }

    public function updateSiteSettings(Request $request)
    {
        $this->checkSuperAdmin();

        $validated = $request->validate([
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'working_hours' => ['nullable', 'string'],
            'instagram_url' => ['nullable', 'url'],
            'linkedin_url' => ['nullable', 'url'],
            'facebook_url' => ['nullable', 'url'],
            'youtube_url' => ['nullable', 'url'],
            'map_embed_url' => ['nullable', 'url'],
        ]);

        foreach ($validated as $key => $value) {
            SiteSetting::set($key, $value);
        }

        return response()->json([
            'success' => true,
            'message' => 'Settings updated successfully!'
        ]);
    }
}
