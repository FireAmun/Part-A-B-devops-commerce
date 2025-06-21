<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Get the authenticated user's email
        $userEmail = Auth::user()->email;

        // Start with base query filtered by user email
        $query = Order::where('user_email', $userEmail);

        // Apply vendor filter if provided
        if ($request->filled('vendor')) {
            $query->where('vendor_id', $request->vendor);
        }

        // Apply status filter if provided
        if ($request->filled('status')) {
            $query->where('order_status', $request->status);
        }

        // Get filtered orders
        $orders = $query->latest()->get();

        return view('orders', compact('orders'));
    }
}
