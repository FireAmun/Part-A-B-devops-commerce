<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\VendorLogIn;
use App\Models\Product;
use App\Models\Order;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get admin from session
        $adminId = session('admin_logged_in');
        if (!$adminId) {
            return redirect()->route('admin.login.form');
        }

        $admin = Admin::find($adminId);
        if (!$admin) {
            session()->forget(['admin_logged_in', 'admin_data']);
            return redirect()->route('admin.login.form');
        }

        $totalUsers = User::count();
        $totalVendors = VendorLogIn::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('amount');

        // Recent orders without user relationship
        $recentOrders = Order::latest()->limit(5)->get();

        // Monthly revenue chart data
        $monthlyRevenue = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $revenue = Order::whereYear('created_at', $date->year)
                           ->whereMonth('created_at', $date->month)
                           ->sum('amount');
            $monthlyRevenue[] = [
                'month' => $date->format('M Y'),
                'revenue' => $revenue
            ];
        }

        return view('admin.dashboard', compact(
            'totalUsers', 'totalVendors', 'totalProducts', 'totalOrders',
            'totalRevenue', 'recentOrders', 'monthlyRevenue', 'admin'
        ));
    }

    // User Management
    public function users()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully');
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $request->validate(['password' => 'string|min:8|confirmed']);
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.users')->with('success', 'User updated successfully');
    }

    public function deleteUser(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('admin.users')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.users')->with('error', 'Failed to delete user. Please try again.');
        }
    }

    // Vendor Management
    public function vendors()
    {
        $vendors = VendorLogIn::latest()->get();
        return view('admin.vendors.index', compact('vendors'));
    }

    public function sendVendorPasswordResetOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $vendor = VendorLogIn::where('name', $request->email)->first();

        if (!$vendor) {
            return response()->json(['success' => false, 'message' => 'Vendor not found']);
        }

        // Generate 6-digit OTP
        $otp = str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT);

        // Delete existing OTPs
        Otp::where('email', $request->email)->delete();

        // Store OTP
        Otp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(10)
        ]);

        // Send email
        try {
            Mail::raw("Your OTP for password reset by admin is: {$otp}\n\nThis OTP will expire in 10 minutes.\n\nUTM Commerce Connect Admin", function ($message) use ($request) {
                $message->to($request->email)
                        ->subject('Admin Password Reset OTP - UTM Commerce Connect')
                        ->from(config('mail.from.address', 'utmcommerceconnect@gmail.com'), 'UTM Commerce Connect Admin');
            });

            return response()->json(['success' => true, 'message' => 'OTP sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to send OTP']);
        }
    }

    public function resetVendorPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|size:6',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Check OTP
        $otpRecord = Otp::where('email', $request->email)
                        ->where('otp', $request->otp)
                        ->where('expires_at', '>', Carbon::now())
                        ->first();

        if (!$otpRecord) {
            return response()->json(['success' => false, 'message' => 'Invalid or expired OTP']);
        }

        // Update vendor password
        $vendor = VendorLogIn::where('name', $request->email)->first();

        if (!$vendor) {
            return response()->json(['success' => false, 'message' => 'Vendor not found']);
        }

        $vendor->password = Hash::make($request->new_password);
        $vendor->save();

        // Delete used OTP
        $otpRecord->delete();

        return response()->json(['success' => true, 'message' => 'Vendor password reset successfully']);
    }

    // Analytics
    public function analytics()
    {
        // Overall statistics
        $totalUsers = User::count();
        $totalVendors = VendorLogIn::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('amount');

        // Vendor-wise analytics (simplified without relationship dependencies)
        $vendorAnalytics = [
            [
                'name' => 'UTM Mart',
                'orders' => Order::where('vendor_id', 1)->count(),
                'revenue' => Order::where('vendor_id', 1)->sum('amount'),
                'products' => Product::where('vendor_id', 1)->count()
            ],
            [
                'name' => 'Setepak Printing',
                'orders' => Order::where('vendor_id', 2)->count(),
                'revenue' => Order::where('vendor_id', 2)->sum('amount'),
                'products' => Product::where('vendor_id', 2)->count()
            ],
            [
                'name' => 'Richiamo Caffe',
                'orders' => Order::where('vendor_id', 3)->count(),
                'revenue' => Order::where('vendor_id', 3)->sum('amount'),
                'products' => Product::where('vendor_id', 3)->count()
            ]
        ];

        // Monthly order trends
        $monthlyOrders = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $count = Order::whereYear('created_at', $date->year)
                         ->whereMonth('created_at', $date->month)
                         ->count();
            $monthlyOrders[] = [
                'month' => $date->format('M Y'),
                'orders' => $count
            ];
        }

        // Top products (simplified without orders relationship)
        $topProducts = Product::latest()->limit(10)->get();

        return view('admin.analytics', compact(
            'totalUsers', 'totalVendors', 'totalProducts', 'totalOrders',
            'totalRevenue', 'vendorAnalytics', 'monthlyOrders', 'topProducts'
        ));
    }

    // Product Management (simplified to avoid relationship issues)
    public function products()
    {
        $products = Product::latest()->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function editProduct(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:0',
            'short_description' => 'required|string',
            'long_description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $product->update($request->all());

        return redirect()->route('admin.products')->with('success', 'Product updated successfully');
    }

    public function deleteProduct(Product $product)
    {
        try {
            $product->delete();
            return redirect()->route('admin.products')->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.products')->with('error', 'Failed to delete product. Please try again.');
        }
    }

    // Admin Management
    public function admins()
    {
        $admins = Admin::latest()->paginate(15);
        return view('admin.admins.index', compact('admins'));
    }

    public function createAdmin()
    {
        return view('admin.admins.create');
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:super_admin,admin',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.admins')->with('success', 'Admin created successfully');
    }

    public function editAdmin(Admin $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }

    public function updateAdmin(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
            'role' => 'required|in:super_admin,admin',
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        if ($request->password) {
            $request->validate(['password' => 'string|min:8|confirmed']);
            $admin->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.admins')->with('success', 'Admin updated successfully');
    }

    public function deleteAdmin(Admin $admin)
    {
        // Prevent deleting yourself
        if ($admin->id === auth('admin')->id()) {
            return redirect()->route('admin.admins')->with('error', 'Cannot delete your own account');
        }

        // Prevent deleting the last super admin
        if ($admin->role === 'super_admin' && Admin::where('role', 'super_admin')->count() <= 1) {
            return redirect()->route('admin.admins')->with('error', 'Cannot delete the last Super Admin account');
        }

        // Only super admins can delete other admins
        if (auth('admin')->user()->role !== 'super_admin') {
            return redirect()->route('admin.admins')->with('error', 'Only Super Admins can delete admin accounts');
        }

        try {
            $admin->delete();
            return redirect()->route('admin.admins')->with('success', 'Admin deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.admins')->with('error', 'Failed to delete admin. Please try again.');
        }
    }

    /**
     * Display a list of all complaints, grouped by vendor.
     */
    public function complaints()
    {
        // Get complaints from the database
        $complaints = \App\Models\Complaint::with('vendor', 'user')->get();

        // Group complaints by vendor
        $groupedComplaints = [
            'general' => [], // For complaints not associated with a vendor
            'vendors' => [] // Will hold arrays of complaints indexed by vendor_id
        ];

        foreach ($complaints as $complaint) {
            if ($complaint->vendor_id) {
                // Initialize the vendor array if not exists
                if (!isset($groupedComplaints['vendors'][$complaint->vendor_id])) {
                    $groupedComplaints['vendors'][$complaint->vendor_id] = [
                        'vendor' => $complaint->vendor,
                        'complaints' => []
                    ];
                }

                $groupedComplaints['vendors'][$complaint->vendor_id]['complaints'][] = $complaint;
            } else {
                // Add to general complaints if no vendor associated
                $groupedComplaints['general'][] = $complaint;
            }
        }

        // Get some statistics for the dashboard
        $stats = [
            'total' => $complaints->count(),
            'open' => $complaints->where('status', 'open')->count(),
            'resolved' => $complaints->where('status', 'resolved')->count(),
            'general_count' => count($groupedComplaints['general']),
            'vendor_count' => count($groupedComplaints['vendors'])
        ];

        return view('admin.complaints.index', compact('groupedComplaints', 'stats'));
    }

    /**
     * Update a complaint's status or add admin response
     */
    public function updateComplaint(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:open,processing,resolved',
            'admin_response' => 'nullable|string|max:1000'
        ]);

        $complaint = \App\Models\Complaint::findOrFail($id);
        $complaint->status = $request->status;

        if ($request->filled('admin_response')) {
            $complaint->admin_response = $request->admin_response;
        }

        $complaint->save();

        return back()->with('success', 'Complaint updated successfully.');
    }
}
