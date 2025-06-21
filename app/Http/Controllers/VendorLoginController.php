<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\VendorLogIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.vendor-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/vendor/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function selectVendor()
    {
        $vendors = Vendor::all();
        return view('auth.vendor-select', compact('vendors'));
    }

    public function showVendorLoginForm($vendor)
    {
        $vendor = Vendor::findOrFail($vendor);
        return view('auth.vendor-login', compact('vendor'));
    }

    public function showUtmMartLogin()
    {
        return view('auth.vendor-login-utm-mart');
    }

    public function loginUtmMart(Request $request)
    {
        return $this->vendorLogin($request, 1, 'vendor.login.utm_mart.form');
    }

    public function showSetepakLogin()
    {
        return view('auth.vendor-login-setepak');
    }

    public function loginSetepak(Request $request)
    {
        return $this->vendorLogin($request, 2, 'vendor.login.setepak.form');
    }

    public function showRichiamoLogin()
    {
        return view('auth.vendor-login-richiamo');
    }

    public function loginRichiamo(Request $request)
    {
        return $this->vendorLogin($request, 3, 'vendor.login.richiamo.form');
    }

    private function vendorLogin(Request $request, $vendorId, $formRoute)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $vendorEmails = [
                1 => 'utmmart2@gmail.com',
                2 => 'setepakprintingservicektf@gmail.com',
                3 => 'richiamocaffe@gmail.com',
            ];

            $vendorEmail = $vendorEmails[$vendorId] ?? null;

            if (!$vendorEmail || $request->input('email') !== $vendorEmail) {
                return redirect()->route($formRoute)
                    ->withErrors(['email' => 'Invalid email for this vendor.'])
                    ->withInput($request->only('email'));
            }

            // Find vendor by email (name field contains email)
            $vendor = VendorLogIn::where('name', $vendorEmail)->first();

            if (!$vendor) {
                return redirect()->route($formRoute)
                    ->withErrors(['email' => 'Vendor account not found. Please contact admin.'])
                    ->withInput($request->only('email'));
            }

            // Check password
            if (Hash::check($request->input('password'), $vendor->password)) {
                session(['vendor_logged_in' => $vendor->id]);
                session()->regenerate();

                // Redirect to correct dashboard based on vendor ID
                if ($vendorId == 1) {
                    return redirect()->route('vendor.dashboard.utm_mart');
                } elseif ($vendorId == 2) {
                    return redirect()->route('vendor.dashboard.setepak');
                } elseif ($vendorId == 3) {
                    return redirect()->route('vendor2.dashboard.caffe');
                }
            }

            return redirect()->route($formRoute)
                ->withErrors(['email' => 'Invalid email or password.'])
                ->withInput($request->only('email'));
        } catch (\Exception $e) {

            return redirect()->route($formRoute)
                ->withErrors(['email' => 'Login failed. Please try again.'])
                ->withInput($request->only('email'));
        }
    }

    public function logout(Request $request)
    {
        session()->forget(['vendor_logged_in', 'vendor_data']);
        session()->flush();
        session()->regenerate();

        return redirect()->route('vendor.select')->with('message', 'Successfully logged out');
    }
}
