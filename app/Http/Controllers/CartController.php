<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Product;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $vendorType = $request->input('vendor_type', null); // Get the vendor type

        Log::info('Adding to cart - full request:', [
            'product_id' => $productId,
            'vendor_type' => $vendorType,
            'request' => $request->all()
        ]);

        // Define UTM Mart products (vendor_id = 1)
        $utmMartProducts = [
            1 => ['name' => 'UTM Shirt', 'price' => 25.00, 'vendor_id' => 1],
            2 => ['name' => 'UTM Cup', 'price' => 15.00, 'vendor_id' => 1],
            3 => ['name' => 'UTM Books', 'price' => 40.00, 'vendor_id' => 1],
        ];

        // Define Richiamo Caffe products (vendor_id = 2)
        $richiamoProducts = [
            // Hot Beverages
            10 => ['name' => 'Espresso', 'price' => 7.90, 'vendor_id' => 2],
            11 => ['name' => 'Double Espresso', 'price' => 9.50, 'vendor_id' => 2],
            12 => ['name' => 'Hot Americano', 'price' => 9.40, 'vendor_id' => 2],
            13 => ['name' => 'Hot Cappuccino', 'price' => 10.70, 'vendor_id' => 2],
            14 => ['name' => 'Hot Caramello Cappuccino', 'price' => 12.20, 'vendor_id' => 2],
            15 => ['name' => 'Hot Hazelnut Cappuccino', 'price' => 12.20, 'vendor_id' => 2],
            16 => ['name' => 'Hot Caffe Latte', 'price' => 10.70, 'vendor_id' => 2],
            17 => ['name' => 'Hot Caramello Latte', 'price' => 12.20, 'vendor_id' => 2],
            18 => ['name' => 'Hot Hazelnut Latte', 'price' => 12.20, 'vendor_id' => 2],
            19 => ['name' => 'Hot Salted Caramello Latte', 'price' => 12.20, 'vendor_id' => 2],
            20 => ['name' => 'Hot White Mochaccino', 'price' => 12.20, 'vendor_id' => 2],
            21 => ['name' => 'Hot Caffe Vanilla', 'price' => 12.20, 'vendor_id' => 2],
            22 => ['name' => 'Hot Chocolate', 'price' => 10.70, 'vendor_id' => 2],
            23 => ['name' => 'Hot Vanilla Chocolate', 'price' => 12.20, 'vendor_id' => 2],
            24 => ['name' => 'Hot Caramello Chocolate', 'price' => 12.20, 'vendor_id' => 2],
            25 => ['name' => 'Hot Hazelnut Chocolate', 'price' => 12.20, 'vendor_id' => 2],
            26 => ['name' => 'Hot Matcha Latte', 'price' => 10.80, 'vendor_id' => 2],
            27 => ['name' => 'Hot Caffe Matcha Latte', 'price' => 11.50, 'vendor_id' => 2],
            28 => ['name' => 'Hot Teh Tarik Premium', 'price' => 9.40, 'vendor_id' => 2],
            29 => ['name' => 'Hot Fresh Lemon Tea', 'price' => 8.10, 'vendor_id' => 2],
            30 => ['name' => 'Hot Fresh Apple Tea', 'price' => 8.10, 'vendor_id' => 2],
            31 => ['name' => 'Hot English Breakfast Tea', 'price' => 5.40, 'vendor_id' => 2],
            32 => ['name' => 'Hot Earl Grey Tea', 'price' => 5.40, 'vendor_id' => 2],
            // Cold Beverages
            40 => ['name' => 'Iced Americano', 'price' => 12.10, 'vendor_id' => 2],
            41 => ['name' => 'Iced White Mochaccino', 'price' => 13.40, 'vendor_id' => 2],
            42 => ['name' => 'Iced Cappuccino', 'price' => 12.10, 'vendor_id' => 2],
            43 => ['name' => 'Iced Caramello Cappuccino', 'price' => 13.40, 'vendor_id' => 2],
            44 => ['name' => 'Iced Hazelnut Cappuccino', 'price' => 13.40, 'vendor_id' => 2],
            45 => ['name' => 'Iced Caffe Latte', 'price' => 12.10, 'vendor_id' => 2],
            46 => ['name' => 'Iced Caramello Latte', 'price' => 13.40, 'vendor_id' => 2],
            47 => ['name' => 'Iced Hazelnut Latte', 'price' => 13.40, 'vendor_id' => 2],
            48 => ['name' => 'Iced Vanilla Latte', 'price' => 13.40, 'vendor_id' => 2],
            49 => ['name' => 'Iced Chocolate', 'price' => 12.10, 'vendor_id' => 2],
            50 => ['name' => 'Iced Classy Dark Chocolate', 'price' => 13.40, 'vendor_id' => 2],
            51 => ['name' => 'Iced Vanilla Chocolate', 'price' => 13.40, 'vendor_id' => 2],
            52 => ['name' => 'Iced Caramello Chocolate', 'price' => 13.40, 'vendor_id' => 2],
            53 => ['name' => 'Iced Hazelnut Chocolate', 'price' => 13.40, 'vendor_id' => 2],
            54 => ['name' => 'Iced Matcha Latte', 'price' => 13.40, 'vendor_id' => 2],
            55 => ['name' => 'Iced Caffe Matcha Latte', 'price' => 14.20, 'vendor_id' => 2],
            56 => ['name' => 'Iced Teh Tarik Premium', 'price' => 12.10, 'vendor_id' => 2],
            57 => ['name' => 'Iced Fresh Lemon Tea', 'price' => 10.70, 'vendor_id' => 2],
            58 => ['name' => 'Iced Fresh Apple Tea', 'price' => 10.70, 'vendor_id' => 2],
            59 => ['name' => 'Fresh Milk Brown Sugar Boba', 'price' => 13.40, 'vendor_id' => 2],
        ];

        // Define vendor3 printing services products (vendor_id = 3)
        $vendor3Products = [
            60 => ['name' => 'A4 Black & White Prints', 'price' => 1.00, 'vendor_id' => 3],
            61 => ['name' => 'A4 Color Prints', 'price' => 5.00, 'vendor_id' => 3],
            62 => ['name' => 'A3 Black & White Prints', 'price' => 3.00, 'vendor_id' => 3],
            63 => ['name' => 'A3 Color Prints', 'price' => 10.00, 'vendor_id' => 3],
            64 => ['name' => 'Photocopying - Black & White', 'price' => 0.10, 'vendor_id' => 3],
            65 => ['name' => 'Photocopying - Color', 'price' => 0.50, 'vendor_id' => 3],
            66 => ['name' => 'Business Cards - Basic Set', 'price' => 20.00, 'vendor_id' => 3],
            67 => ['name' => 'Business Cards - Premium Set', 'price' => 100.00, 'vendor_id' => 3],
            68 => ['name' => 'Small Banner', 'price' => 30.00, 'vendor_id' => 3],
            69 => ['name' => 'Large Banner', 'price' => 200.00, 'vendor_id' => 3],
            70 => ['name' => 'Flyers - Small Batch', 'price' => 50.00, 'vendor_id' => 3],
            71 => ['name' => 'Brochures - Large Batch', 'price' => 300.00, 'vendor_id' => 3],
            72 => ['name' => 'Stickers & Labels - Small', 'price' => 0.50, 'vendor_id' => 3],
            73 => ['name' => 'Stickers & Labels - Large', 'price' => 5.00, 'vendor_id' => 3],
            74 => ['name' => 'T-shirt Printing - Basic', 'price' => 20.00, 'vendor_id' => 3],
            75 => ['name' => 'T-shirt Printing - Premium', 'price' => 50.00, 'vendor_id' => 3],
            76 => ['name' => 'Custom Packaging - Simple', 'price' => 5.00, 'vendor_id' => 3],
            77 => ['name' => 'Custom Packaging - Complex', 'price' => 50.00, 'vendor_id' => 3],
        ];

        // First determine which vendor's product this is
        $vendor_id = null;
        $product = null;

        // Check first if the product exists in the database
        $dbProduct = Product::find($productId);
        if ($dbProduct) {
            $product = [
                'name' => $dbProduct->name,
                'price' => $dbProduct->price,
                'vendor_id' => $dbProduct->vendor_id,
                'thumb_image' => $dbProduct->thumb_image
            ];
            $vendor_id = $dbProduct->vendor_id;

            // If vendor_type was specified, ensure it matches the expected vendor
            if ($vendorType == 'utm' && $vendor_id != 1) {
                $vendor_id = 1; // Force UTM Mart vendor ID for UTM products
            }
        } else if ($vendorType) {
            switch ($vendorType) {
                case 'utm':
                    $vendor_id = 1;
                    if (isset($utmMartProducts[$productId])) {
                        $product = $utmMartProducts[$productId];
                    }
                    Log::info('UTM product identified', ['vendor_id' => $vendor_id, 'product' => $product ?? 'not found']);
                    break;
                case 'vendor2':
                case 'richiamo':
                    $vendor_id = 2; // Vendor ID 2 for Richiamo Caffe
                    if (isset($richiamoProducts[$productId])) {
                        $product = $richiamoProducts[$productId];
                    }
                    Log::info('Richiamo product identified', ['vendor_id' => $vendor_id, 'product' => $product ?? 'not found']);
                    break;
                case 'vendor3':
                case 'print':
                    $vendor_id = 3; // Vendor ID 3 for Setepak Printing
                    if (isset($vendor3Products[$productId])) {
                        $product = $vendor3Products[$productId];
                    }
                    Log::info('Setepak product identified', ['vendor_id' => $vendor_id, 'product' => $product ?? 'not found', 'productId' => $productId]);
                    break;
            }
        } else {
            // Legacy approach - search in appropriate product arrays based on product ID ranges
            if ($productId >= 1 && $productId <= 3) {
                // Product ID 1-3 are UTM Mart products
                if (isset($utmMartProducts[$productId])) {
                    $product = $utmMartProducts[$productId];
                    $vendor_id = 1; // Set UTM Mart vendor_id
                }
            } elseif ($productId >= 10 && $productId <= 59) {
                // Product ID 10-59 are Richiamo products
                if (isset($richiamoProducts[$productId])) {
                    $product = $richiamoProducts[$productId];
                    $vendor_id = 2; // Set Richiamo vendor_id (2)
                }
            } elseif ($productId >= 60 && $productId <= 77) {
                // Product ID 60-77 are Setepak Printing products
                if (isset($vendor3Products[$productId])) {
                    $product = $vendor3Products[$productId];
                    $vendor_id = 3; // Set Setepak Printing vendor_id (3)
                }
            }
        }

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Ensure vendor ID is set correctly
        $product['vendor_id'] = $vendor_id ?: $product['vendor_id'];

        // Ensure vendor_id is set and consistent with our determined vendor_id
        if (!isset($product['vendor_id']) || $product['vendor_id'] != $vendor_id) {
            if (isset($product['vendor_id'])) {
                Log::warning('vendor_id mismatch', [
                    'product_vendor_id' => $product['vendor_id'],
                    'determined_vendor_id' => $vendor_id
                ]);
            } else {
                Log::error('vendor_id not set in product', ['product' => $product]);
            }
            $product['vendor_id'] = $vendor_id; // Use the determined vendor_id
            Log::info('Setting vendor_id from determined value', ['vendor_id' => $vendor_id]);
        }

        // If this is vendor3/print, always force vendor_id to 3 for consistency
        if ($vendorType == 'vendor3' || $vendorType == 'print') {
            $finalVendorId = 3; // Always use 3 for Setepak Printing
            $product['vendor_id'] = 3; // Make sure product array also has correct vendor_id
            Log::info('Overriding vendor_id for unique key', ['from' => $product['vendor_id'], 'to' => $finalVendorId]);
        }
        // If this is vendor2/richiamo, always force vendor_id to 2 for consistency
        else if ($vendorType == 'vendor2' || $vendorType == 'richiamo') {
            $finalVendorId = 2; // Always use 2 for Richiamo Caffe
            Log::info('Overriding vendor_id for unique key', ['from' => $product['vendor_id'], 'to' => $finalVendorId]);
        }
        else {
            $finalVendorId = $product['vendor_id'];
        }            // Create a unique key for this product combining vendor and product ID
        // For vendor3, explicitly force product ID to match expected value for Business Cards - Premium Set
        if ($vendorType == 'vendor3' && $productId == 67) {
            Log::info('Fixing Business Cards - Premium Set product', ['product_id' => $productId]);
            // Ensure we're using the correct product
            $product['name'] = 'Business Cards - Premium Set';
            $product['price'] = 100.00;
        }

        $uniqueKey = $finalVendorId . '-' . $productId;

        Log::info('Creating unique key', ['uniqueKey' => $uniqueKey, 'vendor_id' => $product['vendor_id'], 'name' => $product['name']]);

        $cart = session()->get('cart', []);

        Log::info('Current cart before adding', $cart);

        if (isset($cart[$uniqueKey])) {
            $cart[$uniqueKey]['qty']++;
            Log::info('Increasing quantity for existing item', ['uniqueKey' => $uniqueKey, 'new_qty' => $cart[$uniqueKey]['qty']]);
        } else {
            // If vendor_type is vendor3 or print, force vendor_id to 3
            if ($vendorType == 'vendor3' || $vendorType == 'print') {
                $finalVendorId = 3; // Always use 3 for Setepak Printing
                Log::info('Forcing vendor_id to 3 for Setepak Printing', ['original' => $product['vendor_id']]);
            }
            // If vendor_type is vendor2 or richiamo, force vendor_id to 2
            else if ($vendorType == 'vendor2' || $vendorType == 'richiamo') {
                $finalVendorId = 2; // Always use 2 for Richiamo Caffe
                Log::info('Forcing vendor_id to 2 for Richiamo Caffe', ['original' => $product['vendor_id']]);
            }
            else {
                $finalVendorId = $product['vendor_id'];
            }                // If we have explicit name and price from the request, use those
                if ($vendorType == 'vendor3' && $request->has('name') && $request->has('price')) {
                    $cart[$uniqueKey] = [
                        'name' => $request->input('name'),
                        'price' => $request->input('price'),
                        'qty' => 1,
                        'vendor_id' => $finalVendorId,
                        'product_id' => $productId
                    ];

                    Log::info('Using product details directly from request', [
                        'name' => $request->input('name'),
                        'price' => $request->input('price'),
                        'product_id' => $productId
                    ]);
                }
                // Special handling for certain products
                else if ($vendorType == 'vendor3' && $productId == 67) {
                    // Force correct properties for Business Cards - Premium Set
                    $cart[$uniqueKey] = [
                        'name' => 'Business Cards - Premium Set',
                        'price' => 100.00,
                        'qty' => 1,
                        'vendor_id' => $finalVendorId,
                        'product_id' => $productId
                    ];
                } else if ($vendorType == 'vendor3' && $productId == 68) {
                    // Force correct properties for Small Banner
                    $cart[$uniqueKey] = [
                        'name' => 'Small Banner',
                        'price' => 30.00,
                        'qty' => 1,
                        'vendor_id' => $finalVendorId,
                        'product_id' => $productId
                    ];
                } else {
                    $cart[$uniqueKey] = [
                        'name' => $product['name'],
                        'price' => $product['price'],
                        'qty' => 1,
                        'vendor_id' => $finalVendorId,
                        'product_id' => $productId
                    ];
                }
            Log::info('Adding new item to cart', ['uniqueKey' => $uniqueKey, 'item' => $cart[$uniqueKey]]);
        }

        session()->put('cart', $cart);

        // Log the final cart contents after adding
        Log::info('Final cart after adding:', $cart);

        return response()->json([
            'success' => true,
            'count' => array_sum(array_column($cart, 'qty'))
        ]);
    }

    public function count()
    {
        $cart = session()->get('cart', []);
        return response()->json(['count' => array_sum(array_column($cart, 'qty'))]);
    }

    public function view()
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

        return view('Check-out', ['cart' => $utmCart]);
    }

    public function index()
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

        return view('cart', ['cart' => $utmCart]);
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        $originalCartCount = count($cart);

        // Filter cart to only show Richiamo Caffe items (vendor_id = 2)
        $richiamoCart = [];
        foreach ($cart as $id => $item) {
            if (isset($item['vendor_id']) && $item['vendor_id'] == 2) {
                $richiamoCart[$id] = $item;
            }
        }

        // If there are items from other vendors, remove them from the cart
        if (count($richiamoCart) < $originalCartCount) {
            session()->put('cart', $richiamoCart);

            // Flash a message to inform the user
            session()->flash('info', 'Only Richiamo Caffe products are shown in your cart. Products from other vendors have been removed.');
        }

        return view('vendor2.Check-out', ['cart' => $richiamoCart]);
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->product_id;

        // Handle both new and old format cart items
        if(isset($cart[$id])) {
            // Old format
            unset($cart[$id]);
            session(['cart' => $cart]);
        } else {
            // New format - look for vendor_id-product_id pattern
            foreach ($cart as $key => $item) {
                // Match either the product_id field or extract from composite key
                if ((isset($item['product_id']) && $item['product_id'] == $id) ||
                    (is_string($key) && strpos($key, '-') !== false && explode('-', $key)[1] == $id)) {
                    unset($cart[$key]);
                    session(['cart' => $cart]);
                    break;
                }
            }
        }

        return redirect()->back()->with('success', 'Product removed from cart.');
    }

    public function clear()
    {
        session()->forget('cart');
        session()->forget('coupon');
        return response()->json(['success' => true]);
    }

    public function clearOtherVendors(Request $request)
    {
        $currentVendor = $request->vendor;
        $cart = session()->get('cart', []);
        $filteredCart = [];

        foreach ($cart as $id => $item) {
            // Check both the database product and cart item for vendor_id
            $vendorId = isset($item['vendor_id']) ? $item['vendor_id'] : null;

            // Also check database if there's a product ID
            $actualProductId = isset($item['product_id']) ? $item['product_id'] :
                              (is_string($id) && strpos($id, '-') !== false ? explode('-', $id)[1] : $id);
            $product = Product::find($actualProductId);

            if ($product) {
                $vendorId = $product->vendor_id;
            }

            // Keep items from current vendor only
            if (($currentVendor === 'vendor2' && $vendorId == 2) ||
                ($currentVendor === 'richiamo' && $vendorId == 2) ||
                ($currentVendor === 'vendor3' && $vendorId == 3) ||
                ($currentVendor === 'print' && $vendorId == 3) ||
                ($currentVendor === 'utm' && $vendorId == 1)) {
                $filteredCart[$id] = $item;
                Log::info('Keeping item for ' . $currentVendor, ['id' => $id, 'item' => $item]);
            }

            // If we have a vendor_id in the item itself, check that too
            else if (isset($item['vendor_id'])) {
                if (($currentVendor === 'vendor2' && $item['vendor_id'] == 2) ||
                    ($currentVendor === 'richiamo' && $item['vendor_id'] == 2) ||
                    ($currentVendor === 'vendor3' && $item['vendor_id'] == 3) ||
                    ($currentVendor === 'print' && $item['vendor_id'] == 3) ||
                    ($currentVendor === 'utm' && $item['vendor_id'] == 1)) {
                    $filteredCart[$id] = $item;
                    Log::info('Keeping item for ' . $currentVendor . ' based on item vendor_id', ['id' => $id, 'item' => $item]);
                }
            }
        }

        // Clear session and set filtered cart
        session()->forget('cart');
        session()->forget('coupon');

        if (!empty($filteredCart)) {
            session(['cart' => $filteredCart]);
        }

        return response()->json(['success' => true, 'count' => count($filteredCart)]);
    }
}
