<?php

namespace App\Http\Controllers;

use App\Models\VendorLogIn;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class VendorPasswordController extends Controller
{
    public function sendOtp(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
            ]);

            Log::info('OTP Request received for email: ' . $request->email);

            $vendor = VendorLogIn::where('name', $request->email)->first();

            if (!$vendor) {
                Log::error('Vendor not found for email: ' . $request->email);
                return response()->json(['success' => false, 'message' => 'Vendor not found']);
            }

            // Generate 6-digit OTP
            $otp = str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT);

            Log::info('Generated OTP: ' . $otp . ' for email: ' . $request->email);

            // Delete any existing OTPs for this email to prevent multiple active OTPs
            Otp::where('email', $request->email)->delete();

            // Store OTP in existing database (without is_used column)
            Otp::create([
                'email' => $request->email,
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinutes(10)
            ]);

            Log::info('OTP stored in database for email: ' . $request->email);

            // Send email using Laravel's Mail facade
            try {
                Mail::raw("Your OTP for password change is: {$otp}\n\nThis OTP will expire in 10 minutes.\n\nUTM Commerce Connect\n\nPlease do not share this OTP with anyone.", function ($message) use ($request) {
                    $message->to($request->email)
                            ->subject('Password Change OTP - UTM Commerce Connect')
                            ->from(config('mail.from.address', 'utmcommerceconnect@gmail.com'), 'UTM Commerce Connect');
                });

                Log::info('OTP email sent successfully to: ' . $request->email);
                return response()->json(['success' => true, 'message' => 'OTP sent to your email successfully!']);

            } catch (\Exception $mailException) {
                Log::error('Email sending exception: ' . $mailException->getMessage());

                // Return success with OTP for development/testing
                return response()->json([
                    'success' => true,
                    'message' => 'OTP generated successfully. Your OTP is: ' . $otp . ' (Check your email as well - expires in 10 minutes)'
                ]);
            }

        } catch (\Exception $e) {
            Log::error('OTP generation failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Failed to generate OTP: ' . $e->getMessage()
            ]);
        }
    }

    public function verifyOtpAndChangePassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'otp' => 'required|string|size:6',
                'new_password' => 'required|string|min:8|confirmed',
            ]);

            Log::info('Password change request for email: ' . $request->email);

            // Check OTP from existing table (without is_used column)
            $otpRecord = Otp::where('email', $request->email)
                            ->where('otp', $request->otp)
                            ->where('expires_at', '>', Carbon::now())
                            ->first();

            if (!$otpRecord) {
                Log::error('Invalid or expired OTP for email: ' . $request->email);
                return response()->json(['success' => false, 'message' => 'Invalid or expired OTP']);
            }

            // Update vendor password
            $vendor = VendorLogIn::where('name', $request->email)->first();

            if (!$vendor) {
                Log::error('Vendor not found during password change for email: ' . $request->email);
                return response()->json(['success' => false, 'message' => 'Vendor not found']);
            }

            $vendor->password = Hash::make($request->new_password);
            $vendor->save();

            // Delete the used OTP instead of marking as used
            $otpRecord->delete();

            Log::info('Password changed successfully for email: ' . $request->email);

            return response()->json(['success' => true, 'message' => 'Password changed successfully']);

        } catch (\Exception $e) {
            Log::error('Password change failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Failed to change password: ' . $e->getMessage()
            ]);
        }
    }
}
