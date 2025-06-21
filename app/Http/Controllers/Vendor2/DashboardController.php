<?php

namespace App\Http\Controllers\Vendor2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class DashboardController extends Controller
{
    public function caffe(Request $request)
    {
        $status = $request->get('status');

        $query = Order::where('vendor_id', 3)->orderBy('created_at', 'desc');

        if ($status) {
            $query->where('order_status', $status);
        }

        $orders = $query->get();

        return view('vendor2.dashboard-caffe', compact('orders', 'status'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'order_status' => 'required|in:awaiting confirmation,ready to pick,done'
        ]);

        $order = Order::where('vendor_id', 3)->findOrFail($id);
        $order->order_status = $request->order_status;
        $order->save();

        return redirect()->route('vendor2.dashboard.caffe')->with('success', 'Order status updated successfully!');
    }
}
