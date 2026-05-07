<?php
// app/Http/Middleware/AdminPermission.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPermission
{
    public function handle(Request $request, Closure $next, $permission = null)
    {
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            return redirect()->route('admin.login');
        }

        if ($permission === 'manage-admins' && !$user->isSuperAdmin()) {
            abort(403, 'Only super admin can manage other admins.');
        }

        if ($permission === 'write-access' && !$user->isSuperAdmin()) {
            abort(403, 'Only super admin can create, edit, or delete items.');
        }

        return $next($request);
    }
}
