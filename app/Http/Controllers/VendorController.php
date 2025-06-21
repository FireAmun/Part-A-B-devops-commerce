<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\VendorLogIn;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class VendorController extends Controller
{
    public function index()
    {
        // Fetch UTM Mart products
        $products = Product::where('vendor_id', 1)
            ->where('status', 1)
            ->orderBy('category_id')
            ->get();

        // Group products by category for easier display
        $productsByCategory = $products->groupBy('category_id');

        return view('vendor.index', compact('products', 'productsByCategory'));
    }

    public function utmMartDashboard(Request $request)
    {
        $status = $request->get('status');

        $query = Order::where('vendor_id', 1);
        if ($status) {
            $query->where('order_status', $status);
        }

        $orders = $query->latest()->get();

        // Get complaints for UTM Mart (vendor_id = 0, not 1)
        $complaints = \App\Models\Complaint::where('vendor_id', 0)->latest()->get();

        return view('vendor.dashboard-utm-mart', compact('orders', 'complaints'));
    }

    public function setepakDashboard(Request $request)
    {
        $status = $request->get('status');

        $query = Order::where('vendor_id', 2);
        if ($status) {
            $query->where('order_status', $status);
        }

        $orders = $query->latest()->get();

        // Get complaints for Setepak (vendor_id = 2)
        $complaints = \App\Models\Complaint::where('vendor_id', 2)->latest()->get();

        return view('vendor3.dashboard-setepak', compact('orders', 'complaints'));
    }

    public function richiamoDashboard(Request $request)
    {
        $status = $request->get('status');

        $query = Order::where('vendor_id', 3);
        if ($status) {
            $query->where('order_status', $status);
        }

        $orders = $query->latest()->get();

        // Get complaints for Richiamo Caffe (vendor_id = 3)
        $complaints = \App\Models\Complaint::where('vendor_id', 3)->latest()->get();

        return view('vendor2.dashboard-caffe', compact('orders', 'complaints'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'required|in:awaiting confirmation,ready to pick,done,cancelled'
        ]);

        $order->update([
            'order_status' => $request->order_status
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully');
    }

    public function updateSetepakOrderStatus(Request $request, Order $order)
    {
        return $this->updateOrderStatus($request, $order);
    }

    public function updateRichiamoOrderStatus(Request $request, Order $order)
    {
        return $this->updateOrderStatus($request, $order);
    }

    // Analytics methods
    public function utmMartAnalytics(Request $request)
    {
        $period = $request->get('period', 30);
        $startDate = Carbon::now()->subDays($period);

        $orders = Order::where('vendor_id', 1)
                      ->where('created_at', '>=', $startDate)
                      ->get();

        return response()->json([
            'total_revenue' => number_format($orders->sum('amount'), 2),
            'total_orders' => $orders->count(),
            'avg_order_value' => $orders->count() > 0 ? number_format($orders->sum('amount') / $orders->count(), 2) : '0.00',
            'completion_rate' => $orders->count() > 0 ? round(($orders->where('order_status', 'done')->count() / $orders->count()) * 100, 1) : 0,
            'daily_sales' => [120, 190, 300, 500, 200, 300, 450] // Static for now
        ]);
    }

    public function setepakAnalytics(Request $request)
    {
        $period = $request->get('period', 30);
        $startDate = Carbon::now()->subDays($period);

        $orders = Order::where('vendor_id', 2)
                      ->where('created_at', '>=', $startDate)
                      ->get();

        return response()->json([
            'total_revenue' => number_format($orders->sum('amount'), 2),
            'total_orders' => $orders->count(),
            'avg_order_value' => $orders->count() > 0 ? number_format($orders->sum('amount') / $orders->count(), 2) : '0.00',
            'completion_rate' => $orders->count() > 0 ? round(($orders->where('order_status', 'done')->count() / $orders->count()) * 100, 1) : 0,
            'daily_sales' => [60, 95, 140, 180, 125, 200, 175] // Static for now
        ]);
    }

    public function richiamoAnalytics(Request $request)
    {
        $period = $request->get('period', 30);
        $startDate = Carbon::now()->subDays($period);

        $orders = Order::where('vendor_id', 3)
                      ->where('created_at', '>=', $startDate)
                      ->get();

        return response()->json([
            'total_revenue' => number_format($orders->sum('amount'), 2),
            'total_orders' => $orders->count(),
            'avg_order_value' => $orders->count() > 0 ? number_format($orders->sum('amount') / $orders->count(), 2) : '0.00',
            'completion_rate' => $orders->count() > 0 ? round(($orders->where('order_status', 'done')->count() / $orders->count()) * 100, 1) : 0,
            'daily_sales' => [85, 120, 180, 220, 160, 280, 320] // Static for now
        ]);
    }

    // Password management
    public function sendPasswordOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $vendor = VendorLogIn::where('name', $request->email)->first();

        if (!$vendor) {
            return response()->json(['success' => false, 'message' => 'Vendor not found']);
        }

        $otp = str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT);

        Otp::where('email', $request->email)->delete();

        Otp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(10)
        ]);

        try {
            Mail::raw("Your OTP for password change is: {$otp}\n\nThis OTP will expire in 10 minutes.", function ($message) use ($request) {
                $message->to($request->email)
                        ->subject('Vendor Password Change OTP')
                        ->from(config('mail.from.address', 'utmcommerceconnect@gmail.com'), 'UTM Commerce Connect');
            });

            return response()->json(['success' => true, 'message' => 'OTP sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to send OTP']);
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|size:6',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $otpRecord = Otp::where('email', $request->email)
                        ->where('otp', $request->otp)
                        ->where('expires_at', '>', Carbon::now())
                        ->first();

        if (!$otpRecord) {
            return response()->json(['success' => false, 'message' => 'Invalid or expired OTP']);
        }

        $vendor = VendorLogIn::where('name', $request->email)->first();

        if (!$vendor) {
            return response()->json(['success' => false, 'message' => 'Vendor not found']);
        }

        $vendor->password = Hash::make($request->new_password);
        $vendor->save();

        $otpRecord->delete();

        return response()->json(['success' => true, 'message' => 'Password changed successfully']);
    }

    // UTM Mart Products Management
    public function products()
    {
        $products = Product::where('vendor_id', 1)->latest()->get();
        return view('vendor.products.index', compact('products'));
    }

    public function createProduct()
    {
        return view('vendor.products.create');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:0',
            'short_description' => 'required|string',
            'long_description' => 'nullable|string',
        ]);

        Product::create([
            'name' => $request->name,
            'slug' => str_replace(' ', '-', strtolower($request->name)),
            'vendor_id' => 1,
            'category_id' => 1,
            'brand_id' => 1,
            'qty' => $request->qty,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'price' => $request->price,
            'status' => 1,
            'thumb_image' => 'utm-shirt.jpeg'
        ]);

        return redirect()->route('vendor.products')->with('success', 'Product created successfully');
    }

    public function editProduct(Product $product)
    {
        return view('vendor.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:0',
            'short_description' => 'required|string',
            'long_description' => 'nullable|string',
        ]);

        $product->update($request->all());
        return redirect()->route('vendor.products')->with('success', 'Product updated successfully');
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
        return redirect()->route('vendor.products')->with('success', 'Product deleted successfully');
    }

    // Richiamo Caffe Products Management
    public function vendor2Products()
    {
        $products = Product::where('vendor_id', 3)->latest()->get();
        return view('vendor2.products.index', compact('products'));
    }

    public function createVendor2Product()
    {
        return view('vendor2.products.create');
    }

    public function storeVendor2Product(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:0',
            'short_description' => 'required|string',
            'long_description' => 'nullable|string',
        ]);

        Product::create([
            'name' => $request->name,
            'slug' => str_replace(' ', '-', strtolower($request->name)),
            'vendor_id' => 3,
            'category_id' => 4,
            'brand_id' => 2,
            'qty' => $request->qty,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'price' => $request->price,
            'status' => 1,
            'thumb_image' => str_replace(' ', '-', strtolower($request->name)) . '.png'
        ]);

        return redirect()->route('vendor2.products')->with('success', 'Product created successfully');
    }

    public function editVendor2Product(Product $product)
    {
        return view('vendor2.products.edit', compact('product'));
    }

    public function updateVendor2Product(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:0',
            'short_description' => 'required|string',
            'long_description' => 'nullable|string',
        ]);

        $product->update($request->all());
        return redirect()->route('vendor2.products')->with('success', 'Product updated successfully');
    }

    public function deleteVendor2Product(Product $product)
    {
        $product->delete();
        return redirect()->route('vendor2.products')->with('success', 'Product deleted successfully');
    }

    // Setepak Printing Products Management
    public function vendor3Products()
    {
        $products = Product::where('vendor_id', 2)->latest()->get();
        return view('vendor3.products.index', compact('products'));
    }

    public function createVendor3Product()
    {
        return view('vendor3.products.create');
    }

    public function storeVendor3Product(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:0',
            'short_description' => 'required|string',
            'long_description' => 'nullable|string',
        ]);

        Product::create([
            'name' => $request->name,
            'slug' => str_replace(' ', '-', strtolower($request->name)),
            'vendor_id' => 2,
            'category_id' => 8,
            'brand_id' => 3,
            'qty' => $request->qty,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'price' => $request->price,
            'status' => 1,
            'thumb_image' => 'printing-service.png'
        ]);

        return redirect()->route('vendor3.products')->with('success', 'Service created successfully');
    }

    public function editVendor3Product(Product $product)
    {
        return view('vendor3.products.edit', compact('product'));
    }

    public function updateVendor3Product(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:0',
            'short_description' => 'required|string',
            'long_description' => 'nullable|string',
        ]);

        $product->update($request->all());
        return redirect()->route('vendor3.products')->with('success', 'Service updated successfully');
    }

    public function deleteVendor3Product(Product $product)
    {
        $product->delete();
        return redirect()->route('vendor3.products')->with('success', 'Service deleted successfully');
    }

    // Vendor complaints management
    public function updateComplaintStatus(Request $request, $complaintId)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved,closed',
            'admin_response' => 'nullable|string'
        ]);

        $complaint = \App\Models\Complaint::findOrFail($complaintId);

        $complaint->update([
            'status' => $request->status,
            'admin_response' => $request->admin_response,
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Complaint status updated successfully');
    }
}
