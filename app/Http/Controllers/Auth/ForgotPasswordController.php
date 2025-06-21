<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Check if the email exists in the users table
        $user = DB::table('users')->where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['errors' => ['email' => 'No user found with this email.']], 422);
        }

        try {
            // Generate OTP
            $otp = rand(100000, 999999);
            $expiresAt = Carbon::now()->addMinutes(10);

            // Store OTP in the database
            DB::table('otps')->updateOrInsert(
                ['email' => $request->email],
                ['otp' => $otp, 'expires_at' => $expiresAt, 'updated_at' => now()]
            );

            // Send OTP via email
            Mail::raw(
                "Your OTP for password reset is: $otp\n\n" .
                "This OTP will expire in 10 minutes.\n\n" .
                "If you did not request a password reset, please ignore this email or contact support.",
                function ($message) use ($request) {
                    $message->to($request->email)
                        ->subject('Password Reset OTP');
                }
            );

            return response()->json(['status' => "OTP sent to {$request->email}."]);
        } catch (\Exception $e) {
            Log::error('Failed to send OTP email: ' . $e->getMessage());
            return response()->json(['errors' => ['email' => 'Failed to send OTP. Please try again later.']], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $otpRecord = DB::table('otps')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if ($otpRecord) {
            return redirect()->route('password.reset', ['email' => $request->email])
                ->with('status', 'OTP verified. You can now reset your password.');
        }

        return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = DB::table('users')->where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No user found with this email.']);
        }

        DB::table('users')->where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('status', 'Password reset successfully. You can now log in.');
    }
}
