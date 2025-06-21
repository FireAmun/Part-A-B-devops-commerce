<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next, $requiredRole = null)
    {
        // Check if admin is logged in
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login.form')->with('error', 'Please login to access admin panel');
        }

        $adminId = session('admin_logged_in');
        $admin = Admin::find($adminId);

        if (!$admin) {
            // Clear invalid session
            session()->forget(['admin_logged_in', 'admin_data', 'admin_role']);
            return redirect()->route('admin.login.form')->with('error', 'Admin account not found');
        }

        // Check if specific role is required (for super admin routes)
        if ($requiredRole === 'super_admin' && $admin->role !== 'super_admin') {
            abort(403, 'Access denied. Super Admin privileges required.');
        }

        // Make admin data available in all views
        view()->share('currentAdmin', $admin);

        return $next($request);
    }
}
