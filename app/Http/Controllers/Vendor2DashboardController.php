<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\Complaint;

class Vendor2DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        try {
            $query = Order::where('vendor_id', 3); // Richiamo Caffe

            if ($request->has('status') && $request->status != '') {
                $query->where('order_status', $request->status);
                $status = $request->status;
            } else {
                $status = null;
            }

            $orders = $query->orderBy('created_at', 'desc')->get();

            // Get complaints for Richiamo Caffe (vendor_id = 3), exclude general complaints
            $complaints = Complaint::where('complaint_type', 'vendor_specific')
                                  ->where('vendor_id', 3)
                                  ->orderBy('created_at', 'desc')
                                  ->get();


            return view('vendor2.dashboard-caffe', compact('orders', 'status', 'complaints'));
        } catch (\Exception $e) {

            // Fallback with empty collections
            $orders = collect();
            $complaints = collect();
            $status = null;

            return view('vendor2.dashboard-caffe', compact('orders', 'status', 'complaints'));
        }
    }

    public function updateOrderStatus(Request $request, $orderId)
    {
        $request->validate([
            'order_status' => 'required|in:awaiting confirmation,ready to pick,done,cancelled'
        ]);

        $order = Order::where('id', $orderId)
                     ->where('vendor_id', 3)
                     ->firstOrFail();

        $order->update([
            'order_status' => $request->order_status
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    public function updateComplaintStatus(Request $request, $complaintId)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved,closed',
            'admin_response' => 'nullable|string'
        ]);

        $complaint = Complaint::where('id', $complaintId)
                             ->where('vendor_id', 3)
                             ->firstOrFail();

        $complaint->update([
            'status' => $request->status,
            'admin_response' => $request->admin_response
        ]);

        return redirect()->back()->with('success', 'Complaint status updated successfully.');
    }

    public function manageProducts(Request $request)
    {
        $query = \App\Models\Product::where('vendor_id', 3); // Richiamo Caffe

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->orderBy('created_at', 'desc')->get();

        return view('vendor2.products', compact('products'));
    }

    public function createProduct()
    {
        return view('vendor2.product-form');
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
            'thumb_image' => strtolower(str_replace(' ', '-', $request->name)) . '.png',
            'vendor_id' => 3,
            'category_id' => 4,
            'brand_id' => 2,
            'qty' => $request->qty,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'price' => $request->price,
            'status' => $request->status,
        ]);

        return redirect()->route('vendor2.products.create')->with('success', 'Menu item added successfully!');
    }

    public function editProduct($id)
    {
        $product = \App\Models\Product::where('vendor_id', 3)->findOrFail($id);
        return view('vendor2.product-form', compact('product'));
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

        $product = \App\Models\Product::where('vendor_id', 3)->findOrFail($id);

        $product->update([
            'name' => $request->name,
            'thumb_image' => strtolower(str_replace(' ', '-', $request->name)) . '.png',
            'qty' => $request->qty,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'price' => $request->price,
            'status' => $request->status,
        ]);

        return redirect()->route('vendor2.products.edit', $id)->with('success', 'Menu item updated successfully!');
    }

    public function deleteProduct($id)
    {
        $product = \App\Models\Product::where('vendor_id', 3)->findOrFail($id);
        $product->delete();

        return redirect()->route('vendor2.products')->with('success', 'Product deleted successfully.');
    }
}
