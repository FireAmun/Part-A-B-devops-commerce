<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
class VendorDashboardController extends Controller
{
    public function utmMart(Request $request)
    {
        // Orders use vendor_id = 1
        $orders = Order::where('vendor_id', 1);

        if ($request->has('status') && $request->status) {
            $orders->where('order_status', $request->status);
        }

        $orders = $orders->orderBy('created_at', 'desc')->get();

        // Complaints use vendor_id = 0
        $complaints = Complaint::where('vendor_id', 0)
                               ->orderBy('created_at', 'desc')
                               ->get();

        return view('vendor.dashboard-utm-mart', compact('orders', 'complaints'));
    }

    public function setepak(Request $request)
    {
        $vendor_id = 2;
        $orders = Order::where('vendor_id', $vendor_id);

        if ($request->has('status') && $request->status) {
            $orders->where('order_status', $request->status);
        }

        $orders = $orders->orderBy('created_at', 'desc')->get();
        $complaints = Complaint::where('vendor_id', $vendor_id)->orderBy('created_at', 'desc')->get();

        return view('vendor3.dashboard-setepak', compact('orders', 'complaints'));
    }

    public function caffe(Request $request)
    {
        $vendor_id = 3;
        $orders = Order::where('vendor_id', $vendor_id);

        if ($request->has('status') && $request->status) {
            $orders->where('order_status', $request->status);
        }

        $orders = $orders->orderBy('created_at', 'desc')->get();
        $complaints = Complaint::where('vendor_id', $vendor_id)->orderBy('created_at', 'desc')->get();

        return view('vendor2.dashboard-caffe', compact('orders', 'complaints'));
    }

    // Dedicated analytics endpoints
    public function utmMartAnalytics(Request $request)
    {
        $period = $request->get('period', 7);
        // Analytics for orders use vendor_id = 1
        $analytics = $this->getAnalyticsData(1, $period);
        return response()->json($analytics);
    }

    public function setepakAnalytics(Request $request)
    {
        $period = $request->get('period', 7);
        $analytics = $this->getAnalyticsData(2, $period);
        return response()->json($analytics);
    }

    public function caffeAnalytics(Request $request)
    {
        $period = $request->get('period', 7);
        $analytics = $this->getAnalyticsData(3, $period);
        return response()->json($analytics);
    }

    // Products management methods
    public function manageProducts()
    {
        // Products use vendor_id = 1
        $vendor_id = 1;
        $products = \App\Models\Product::where('vendor_id', $vendor_id)->get();
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
            'thumb_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product = new \App\Models\Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id = 1; // Products use vendor_id = 1
        $product->category_id = 1; // Default category
        $product->brand_id = 1; // Default brand
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->price = $request->price;
        $product->status = 1;

        if ($request->hasFile('thumb_image')) {
            $image = $request->file('thumb_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $product->thumb_image = $imageName;
        }

        $product->save();

        return redirect()->route('vendor.products')->with('success', 'Product created successfully');
    }

    public function editProduct($id)
    {
        $product = \App\Models\Product::where('vendor_id', 1)->findOrFail($id); // Products use vendor_id = 1
        return view('vendor.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:0',
            'short_description' => 'required|string',
            'long_description' => 'nullable|string',
            'thumb_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product = \App\Models\Product::where('vendor_id', 1)->findOrFail($id); // Products use vendor_id = 1
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->price = $request->price;

        if ($request->hasFile('thumb_image')) {
            $image = $request->file('thumb_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $product->thumb_image = $imageName;
        }

        $product->save();

        return redirect()->route('vendor.products')->with('success', 'Product updated successfully');
    }

    public function deleteProduct($id)
    {
        $product = \App\Models\Product::where('vendor_id', 1)->findOrFail($id); // Products use vendor_id = 1
        $product->delete();

        return redirect()->route('vendor.products')->with('success', 'Product deleted successfully');
    }

    private function getAnalyticsData($vendor_id, $period = 7)
    {
        $startDate = now()->subDays($period);

        // Orders analytics use the provided vendor_id
        $orders = Order::where('vendor_id', $vendor_id)
                      ->where('created_at', '>=', $startDate)
                      ->get();

        $totalRevenue = $orders->sum('amount');
        $totalOrders = $orders->count();
        $avgOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;
        $completionRate = $totalOrders > 0 ?
            round(($orders->where('order_status', 'done')->count() / $totalOrders) * 100, 1) : 0;

        // Generate daily sales data for the chart
        $dailySales = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dayTotal = Order::where('vendor_id', $vendor_id)
                           ->whereDate('created_at', $date)
                           ->sum('amount');
            $dailySales[] = (float) $dayTotal;
        }

        return [
            'total_revenue' => number_format($totalRevenue, 2),
            'total_orders' => $totalOrders,
            'avg_order_value' => number_format($avgOrderValue, 2),
            'completion_rate' => $completionRate,
            'daily_sales' => $dailySales,
            'success' => true
        ];
    }

    public function updateOrderStatus(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->update(['order_status' => $request->order_status]);

        return back()->with('success', 'Order status updated successfully!');
    }

    public function updateOrderStatusUtmMart(Request $request, $orderId)
    {
        return $this->updateOrderStatus($request, $orderId);
    }

    public function updateOrderStatusSetepak(Request $request, $orderId)
    {
        return $this->updateOrderStatus($request, $orderId);
    }

    public function updateOrderStatusCaffe(Request $request, $orderId)
    {
        return $this->updateOrderStatus($request, $orderId);
    }

    // Products management methods for Vendor2 (Richiamo Caffe)
    public function manageVendor2Products()
    {
        $vendor_id = 3; // Richiamo Caffe
        $products = \App\Models\Product::where('vendor_id', $vendor_id)->get();
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
            'thumb_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product = new \App\Models\Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id = 3; // Richiamo Caffe
        $product->category_id = 4; // Default category for beverages
        $product->brand_id = 2; // Richiamo brand
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->price = $request->price;
        $product->status = 1;

        if ($request->hasFile('thumb_image')) {
            $image = $request->file('thumb_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/caffe'), $imageName);
            $product->thumb_image = $imageName;
        } else {
            $product->thumb_image = str_replace(' ', '-', strtolower($request->name)) . '.png';
        }

        $product->save();

        return redirect()->route('vendor2.products')->with('success', 'Menu item created successfully');
    }

    public function editVendor2Product($id)
    {
        $product = \App\Models\Product::where('vendor_id', 3)->findOrFail($id);
        return view('vendor2.products.edit', compact('product'));
    }

    public function updateVendor2Product(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:0',
            'short_description' => 'required|string',
            'long_description' => 'nullable|string',
            'thumb_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product = \App\Models\Product::where('vendor_id', 3)->findOrFail($id);
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->price = $request->price;

        if ($request->hasFile('thumb_image')) {
            $image = $request->file('thumb_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/caffe'), $imageName);
            $product->thumb_image = $imageName;
        }

        $product->save();

        return redirect()->route('vendor2.products')->with('success', 'Menu item updated successfully');
    }

    public function deleteVendor2Product($id)
    {
        $product = \App\Models\Product::where('vendor_id', 3)->findOrFail($id);
        $product->delete();

        return redirect()->route('vendor2.products')->with('success', 'Menu item deleted successfully');
    }

    // Products management methods for Vendor3 (Setepak Printing)
    public function manageVendor3Products()
    {
        $vendor_id = 2; // Setepak Printing
        $products = \App\Models\Product::where('vendor_id', $vendor_id)->get();
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

        $product = new \App\Models\Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id = 2; // Setepak Printing
        $product->category_id = 8; // Default category for printing
        $product->brand_id = 3; // Setepak brand
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->price = $request->price;
        $product->status = 1;
        $product->thumb_image = 'icon'; // Use icon-based display

        $product->save();

        return redirect()->route('vendor3.products')->with('success', 'Service created successfully');
    }

    public function editVendor3Product($id)
    {
        $product = \App\Models\Product::where('vendor_id', 2)->findOrFail($id);
        return view('vendor3.products.edit', compact('product'));
    }

    public function updateVendor3Product(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:0',
            'short_description' => 'required|string',
            'long_description' => 'nullable|string',
        ]);

        $product = \App\Models\Product::where('vendor_id', 2)->findOrFail($id);
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->price = $request->price;

        $product->save();

        return redirect()->route('vendor3.products')->with('success', 'Service updated successfully');
    }

    public function deleteVendor3Product($id)
    {
        $product = \App\Models\Product::where('vendor_id', 2)->findOrFail($id);
        $product->delete();

        return redirect()->route('vendor3.products')->with('success', 'Service deleted successfully');
    }

    // Add complaint status update method if it doesn't exist
    public function updateComplaintStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved,closed',
            'admin_response' => 'nullable|string|max:1000',
        ]);

        $complaint = Complaint::findOrFail($id);
        $complaint->status = $request->status;

        if ($request->admin_response) {
            $complaint->admin_response = $request->admin_response;
        }

        $complaint->save();

        return back()->with('success', 'Complaint status updated successfully!');
    }
}
