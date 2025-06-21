<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Vendor;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    public function applyCoupon(Request $request)
    {
        $cart = session()->get('cart', []);
        $coupon = Coupon::where('code', $request->coupon_code)
            ->where('status', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        if(!$coupon) {
            return back()->with('error', 'Invalid or expired coupon.');
        }

        session(['coupon' => $coupon]);
        return back()->with('success', 'Coupon applied!');
    }

    public function confirmation()
    {
        $cart = session()->get('cart', []);
        $originalCartCount = count($cart);

        // Filter cart to only show UTM Mart items (vendor_id = 1)
        $utmCart = [];
        foreach ($cart as $id => $item) {
            if (isset($item['vendor_id']) && $item['vendor_id'] == 1) {
                $utmCart[$id] = $item;
            }
        }

        // If there are items from other vendors, remove them from the cart
        if (count($utmCart) < $originalCartCount) {
            session()->put('cart', $utmCart);

            // Flash a message to inform the user
            session()->flash('info', 'Only UTM Mart products are shown in your cart. Products from other vendors have been removed.');
        }

        $vendors = Vendor::all();
        return view('checkout-confirmation', ['cart' => $utmCart, 'vendors' => $vendors]);
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'vendor_id' => 'required|exists:vendors,id',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $cart = session()->get('cart', []);

        // Filter cart to only include products from the selected vendor
        $vendorCart = [];
        $vendorId = $request->vendor_id;

        foreach ($cart as $key => $item) {
            if (isset($item['vendor_id']) && $item['vendor_id'] == $vendorId) {
                $vendorCart[$key] = $item;
            }
        }

        if (empty($vendorCart)) {
            return redirect()->route('checkout.confirmation')->with('error', 'Your cart is empty for this vendor.');
        }

        $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Calculate total amount and product quantity using filtered cart
        $amount = 0;
        $product_qty = 0;
        foreach ($vendorCart as $item) {
            $amount += $item['price'] * $item['qty'];
            $product_qty += $item['qty'];
        }

        // Generate a simple invoice id (you may want to improve this)
        $invoice_id = 'INV-' . strtoupper(uniqid());

        // Set default values for fields not collected from the form
        $currency_name = 'MYR';
        $currency_icon = 'RM';
        $payment_method = 'QR DuitNow';
        $payment_status = 0; // 0 = unpaid, 1 = paid
        $coupon = session('coupon') ? json_encode(session('coupon')) : '';
        $order_status = 'awaiting confirmation';

        $order = Order::create([
            'invocie_id' => $invoice_id,
            'amount' => $amount,
            'currency_name' => $currency_name,
            'currency_icon' => $currency_icon,
            'product_qty' => $product_qty,
            'payment_method' => $payment_method,
            'payment_status' => $payment_status,
            'coupon' => $coupon,
            'order_status' => $order_status,
            'user_name' => $request->name,
            'user_phone' => $request->phone,
            'user_email' => $request->email,
            'payment_proof' => $paymentProofPath,
            'vendor_id' => $vendorId,
            'products' => $vendorCart, // Use filtered cart
        ]);

        // Remove only this vendor's products from the cart
        foreach ($vendorCart as $key => $item) {
            unset($cart[$key]);
        }

        session()->put('cart', $cart);  // Update the cart with remaining products
        session()->forget('coupon');

        // Add a more visible success message and redirect to orders page
        return redirect()->route('orders.index')->with('success', 'Your UTM Mart order has been placed successfully! Order ID: ' . $invoice_id);
    }

    public function placeOrderVendor2(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'vendor_id' => 'required|exists:vendors,id',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Get cart data
        $cart = session()->get('cart', []);

        // Filter cart to only include Richiamo Caffe products (vendor_id = 2)
        $richiamoCart = [];
        foreach ($cart as $key => $item) {
            if (isset($item['vendor_id']) && $item['vendor_id'] == 2) {
                $richiamoCart[$key] = $item;
            }
        }

        if (empty($richiamoCart)) {
            return redirect()->route('vendor2.cart.view')->with('error', 'Your Richiamo Caffe cart is empty.');
        }

        // Handle file upload
        $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Calculate total amount and product quantity using filtered cart
        $amount = 0;
        $product_qty = 0;
        foreach ($richiamoCart as $item) {
            $amount += $item['price'] * $item['qty'];
            $product_qty += $item['qty'];
        }

        // Generate a simple invoice id
        $invoice_id = 'INV-' . strtoupper(uniqid());

        // Set default values for fields
        $currency_name = 'MYR';
        $currency_icon = 'RM';
        $payment_method = 'QR DuitNow';
        $payment_status = 0; // 0 = unpaid, 1 = paid
        $coupon = session('coupon') ? json_encode(session('coupon')) : '';
        $order_status = 'awaiting confirmation';

        $order = Order::create([
            'invocie_id' => $invoice_id,
            'amount' => $amount,
            'currency_name' => $currency_name,
            'currency_icon' => $currency_icon,
            'product_qty' => $product_qty,
            'payment_method' => $payment_method,
            'payment_status' => $payment_status,
            'coupon' => $coupon,
            'order_status' => $order_status,
            'user_name' => $request->name,
            'user_phone' => $request->phone,
            'user_email' => $request->email,
            'payment_proof' => $paymentProofPath,
            'vendor_id' => $request->vendor_id,
            'products' => $richiamoCart, // Use filtered cart
        ]);

        // Remove only Richiamo products from the cart
        foreach ($richiamoCart as $key => $item) {
            unset($cart[$key]);
        }

        session()->put('cart', $cart);  // Update the cart with remaining products
        session()->forget('coupon');

        // Use a stronger success message styling and redirect to orders page
        return redirect()->route('orders.index')->with('success', 'Your coffee order has been placed successfully! Order ID: ' . $invoice_id);
    }
}
