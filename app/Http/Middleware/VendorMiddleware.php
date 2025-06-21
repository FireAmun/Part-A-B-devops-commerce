<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\VendorLogIn;

class VendorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('vendor_logged_in')) {
            return redirect()->route('vendor.select')->with('error', 'Please login to access vendor dashboard');
        }

        $vendorId = session('vendor_logged_in');
        $vendor = VendorLogIn::find($vendorId);

        if (!$vendor) {
            session()->forget(['vendor_logged_in', 'vendor_data']);
            return redirect()->route('vendor.select')->with('error', 'Vendor account not found');
        }

        // Make vendor data available in views
        view()->share('currentVendor', $vendor);

        return $next($request);
    }
}
