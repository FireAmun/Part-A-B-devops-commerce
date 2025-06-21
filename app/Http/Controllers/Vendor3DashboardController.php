<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\Complaint;

class Vendor3DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = Order::where('vendor_id', 2); // Setepak Printing Service

        if ($request->has('status') && $request->status != '') {
            $query->where('order_status', $request->status);
            $status = $request->status;
        } else {
            $status = null;
        }

        $orders = $query->orderBy('created_at', 'desc')->get();

        // Get complaints only for Setepak Printing (vendor_id = 2), exclude general complaints
        $complaints = Complaint::where('complaint_type', 'vendor_specific')
                              ->where('vendor_id', 2)
                              ->orderBy('created_at', 'desc')
                              ->get();

        return view('vendor3.dashboard-setepak', compact('orders', 'status', 'complaints'));
    }

    public function updateOrderStatus(Request $request, $orderId)
    {
        $request->validate([
            'order_status' => 'required|in:awaiting confirmation,ready to pick,done,cancelled'
        ]);

        $order = Order::where('id', $orderId)
                     ->where('vendor_id', 2)
                     ->firstOrFail();

        $order->update([
            'order_status' => $request->order_status
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    public function manageProducts(Request $request)
    {
        $query = \App\Models\Product::where('vendor_id', 2); // Setepak Printing

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->orderBy('created_at', 'desc')->get();

        return view('vendor3.products', compact('products'));
    }

    public function createProduct()
    {
        return view('vendor3.product-form');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:0',
            'short_description' => 'required|string|max:500',
            'long_description' => 'nullable|string',
            'status' => 'required|in:0,1'
        ]);

        \App\Models\Product::create([
            'name' => $request->name,
            'thumb_image' => 'printing-service.png',
            'vendor_id' => 2,
            'category_id' => 8,
            'brand_id' => 3,
            'qty' => $request->qty,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'price' => $request->price,
            'status' => $request->status,
        ]);

        return redirect()->route('vendor3.products.create')->with('success', 'Service added successfully!');
    }

    public function editProduct($id)
    {
        $product = \App\Models\Product::where('vendor_id', 2)->findOrFail($id);
        return view('vendor3.product-form', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:0',
            'short_description' => 'required|string|max:500',
            'long_description' => 'nullable|string',
            'status' => 'required|in:0,1'
        ]);

        $product = \App\Models\Product::where('vendor_id', 2)->findOrFail($id);

        $product->update([
            'name' => $request->name,
            'qty' => $request->qty,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'price' => $request->price,
            'status' => $request->status,
        ]);

        return redirect()->route('vendor3.products.edit', $id)->with('success', 'Service updated successfully!');
    }

    public function deleteProduct($id)
    {
        $product = \App\Models\Product::where('vendor_id', 2)->findOrFail($id);
        $product->delete();

        return redirect()->route('vendor3.products')->with('success', 'Service deleted successfully.');
    }

    public function updateComplaintStatus(Request $request, $complaintId)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved,closed',
            'admin_response' => 'nullable|string'
        ]);

        $complaint = \App\Models\Complaint::where('id', $complaintId)
                                         ->where('vendor_id', 2)
                                         ->firstOrFail();

        $complaint->update([
            'status' => $request->status,
            'admin_response' => $request->admin_response
        ]);

        return redirect()->back()->with('success', 'Complaint status updated successfully.');
    }
}
