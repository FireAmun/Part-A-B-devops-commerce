<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        // If admin is already logged in, redirect to dashboard
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            // Clear any existing sessions
            session()->flush();

            // Set admin session
            session([
                'admin_logged_in' => $admin->id,
                'admin_data' => $admin,
                'admin_role' => $admin->role
            ]);

            // Regenerate session ID for security
            session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        // Clear admin session data
        session()->forget(['admin_logged_in', 'admin_data', 'admin_role']);
        session()->flush();
        session()->regenerate();

        return redirect()->route('admin.login.form')->with('message', 'Successfully logged out');
    }
}
