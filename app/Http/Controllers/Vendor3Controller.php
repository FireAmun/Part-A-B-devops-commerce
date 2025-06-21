<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\Order;

class Vendor3Controller extends Controller
{
    public function index()
    {
        return view('vendor3.index');
    }

    public function cartView()
    {
        $cart = session()->get('cart', []);
        $originalCartCount = count($cart);

        // Debug - log the entire cart content
        Log::info('Full cart content: ', $cart);

        // Filter cart to only show vendor3 items
        $vendor3Cart = [];
        foreach ($cart as $id => $item) {
            Log::info('Checking cart item: ', ['id' => $id, 'item' => $item]);
            if (isset($item['vendor_id']) && $item['vendor_id'] == 3) { // vendor_id 3 for Setepak Printing
                $vendor3Cart[$id] = $item;
                Log::info('Added to vendor3 cart: ', ['id' => $id, 'item' => $item]);
            }
        }

        // If there are items from other vendors, remove them from the cart
        if (count($vendor3Cart) < $originalCartCount) {
            session()->put('cart', $vendor3Cart);

            // Flash a message to inform the user
            session()->flash('info', 'Only Setepak Printing products are shown in your cart. Products from other vendors have been removed.');
        }

        Log::info('Filtered vendor3 cart: ', $vendor3Cart);

        return view('vendor3.Check-out', ['cart' => $vendor3Cart]);
    }

    public function checkoutConfirmation()
    {
        $cart = session()->get('cart', []);
        $originalCartCount = count($cart);

        // Filter cart to only show vendor3 items
        $vendor3Cart = [];
        foreach ($cart as $id => $item) {
            if (isset($item['vendor_id']) && $item['vendor_id'] == 3) { // vendor_id 3 for Setepak Printing
                $vendor3Cart[$id] = $item;
            }
        }

        // If there are items from other vendors, remove them from the cart
        if (count($vendor3Cart) < $originalCartCount) {
            session()->put('cart', $vendor3Cart);

            // Flash a message to inform the user
            session()->flash('info', 'Only Setepak Printing products are shown in your cart. Products from other vendors have been removed.');
        }

        return view('vendor3.checkout-confirmation', ['cart' => $vendor3Cart]);
    }

    public function wishlistView()
    {
        $wishlist = session()->get('wishlist', []);
        $originalWishlistCount = count($wishlist);

        // Filter wishlist to only show vendor3 items (Setepak Printing)
        $vendor3Wishlist = [];
        foreach ($wishlist as $id => $item) {
            if (isset($item['vendor_id']) && $item['vendor_id'] == 3) { // vendor_id 3 for Setepak Printing
                $vendor3Wishlist[$id] = $item;
            }
        }

        // If there are items from other vendors, update the wishlist session
        if (count($vendor3Wishlist) < $originalWishlistCount) {
            session()->put('wishlist', $vendor3Wishlist);

            // Flash a message to inform the user
            session()->flash('info', 'Only Setepak Printing products are shown in your wishlist. Products from other vendors have been removed.');
        }

        return view('vendor3.Wishlist', ['wishlist' => $vendor3Wishlist]);
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'print_file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,gif|max:10240', // 10MB max for print files
        ]);

        $cart = session()->get('cart', []);
        $vendor3Cart = [];
        $total = 0;

        foreach ($cart as $id => $item) {
            if (isset($item['vendor_id']) && $item['vendor_id'] == 3) {
                $vendor3Cart[$id] = $item;
                $total += $item['price'] * $item['qty'];
            }
        }

        if (empty($vendor3Cart)) {
            return redirect()->route('vendor3.cart.view')->with('error', 'Your cart is empty.');
        }

        // Handle payment proof upload
        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        // Handle print file upload
        $printFilePath = null;
        if ($request->hasFile('print_file')) {
            $printFilePath = $request->file('print_file')->store('print_files', 'public');
        }

        // Create order
        $order = Order::create([
            'invocie_id' => 'SPK-' . strtoupper(uniqid()),
            'user_name' => $request->name,
            'user_phone' => $request->phone,
            'user_email' => $request->email,
            'vendor_id' => 3, // Setepak Printing
            'products' => $vendor3Cart, // The products field is cast to 'array' in the Order model
            'amount' => $total,
            'currency_name' => 'Malaysian Ringgit',
            'currency_icon' => 'RM',
            'product_qty' => array_sum(array_column($vendor3Cart, 'qty')),
            'payment_method' => 'Bank Transfer',
            'payment_status' => 0,
            'coupon' => '',
            'order_status' => 'awaiting confirmation',
            'payment_proof' => $paymentProofPath,
            'print_file' => $printFilePath,
            'notes' => $request->notes,
        ]);

        // Clear vendor3 items from cart
        foreach ($vendor3Cart as $id => $item) {
            unset($cart[$id]);
        }
        session()->put('cart', $cart);

        // Use a stronger success message styling and redirect to orders page
        return redirect()->route('orders.index')->with('success', 'Your printing order has been placed successfully! Order ID: ' . $order->invocie_id);
    }

    public function cartDebug()
    {
        $cart = session()->get('cart', []);
        $keys = array_keys($cart);

        return response()->json([
            'all_cart_items' => $cart,
            'cart_keys' => $keys,
            'cart_count' => count($cart),
            'session_id' => session()->getId()
        ]);
    }
}
