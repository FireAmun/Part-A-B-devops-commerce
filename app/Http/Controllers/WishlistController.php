<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class WishlistController extends Controller
{
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $vendorType = $request->input('vendor_type', null); // Get the vendor type

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

        // If vendor_type is specified, set the correct vendor_id first
        if ($vendorType) {
            switch ($vendorType) {
                case 'utm':
                    $vendor_id = 1; // UTM Mart
                    break;
                case 'vendor2':
                case 'richiamo':
                    $vendor_id = 2; // Richiamo Caffe
                    break;
                case 'vendor3':
                case 'print':
                    $vendor_id = 3; // Setepak Printing
                    break;
            }
            \Illuminate\Support\Facades\Log::info('Vendor ID from vendor_type', [
                'vendor_type' => $vendorType,
                'vendor_id' => $vendor_id
            ]);
        }

        // Check first if the product exists in the database
        $dbProduct = Product::find($productId);
        if ($dbProduct) {
            $product = [
                'name' => $dbProduct->name,
                'price' => $dbProduct->price,
                'vendor_id' => $dbProduct->vendor_id,
                'thumb_image' => $dbProduct->thumb_image
            ];

            // If vendor_id was set from vendor_type, override the database vendor_id
            if ($vendor_id) {
                $product['vendor_id'] = $vendor_id;
            } else {
                $vendor_id = $dbProduct->vendor_id;
            }
        } else if ($vendorType) {
            switch ($vendorType) {
                case 'utm':
                    $vendor_id = 1;
                    if (isset($utmMartProducts[$productId])) {
                        $product = $utmMartProducts[$productId];
                    }
                    break;
                case 'vendor2':
                case 'richiamo':
                    $vendor_id = 2;
                    if (isset($richiamoProducts[$productId])) {
                        $product = $richiamoProducts[$productId];
                    }
                    break;
                case 'vendor3':
                case 'print':
                    $vendor_id = 3;
                    if (isset($vendor3Products[$productId])) {
                        $product = $vendor3Products[$productId];
                    }
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
                    $vendor_id = 2; // Set Richiamo vendor_id to 2
                }
            } elseif ($productId >= 60 && $productId <= 77) {
                // Product ID 60-77 are vendor3 products
                if (isset($vendor3Products[$productId])) {
                    $product = $vendor3Products[$productId];
                    $vendor_id = 3; // Set vendor3 vendor_id
                }
            }
        }

        if (!$product) {
            // If we have name and price from request, create a product on the fly
            if ($request->has('name') && $request->has('price') && $vendor_id) {
                $product = [
                    'name' => $request->input('name'),
                    'price' => $request->input('price'),
                    'vendor_id' => $vendor_id
                ];
                \Illuminate\Support\Facades\Log::info('Created product on the fly', $product);
            } else {
                return response()->json(['error' => 'Product not found'], 404);
            }
        }

        // Ensure vendor ID is set correctly based on vendor_type
        if ($vendorType == 'utm' || $vendorType == 'utm_mart') {
            $product['vendor_id'] = 1; // Force UTM Mart vendor_id
        } else if ($vendorType == 'vendor2' || $vendorType == 'richiamo') {
            $product['vendor_id'] = 2; // Force Richiamo Caffe vendor_id
        } else if ($vendorType == 'vendor3' || $vendorType == 'print') {
            $product['vendor_id'] = 3; // Force Setepak Printing vendor_id
        } else {
            $product['vendor_id'] = $vendor_id ?: $product['vendor_id'];
        }

        // Create a unique key for this product combining vendor and product ID
        $uniqueKey = $product['vendor_id'] . '-' . $productId;

        \Illuminate\Support\Facades\Log::info('Creating wishlist item with key', [
            'uniqueKey' => $uniqueKey,
            'vendor_id' => $product['vendor_id'],
            'productId' => $productId
        ]);

        $wishlist = session()->get('wishlist', []);

        if (!isset($wishlist[$uniqueKey])) {
            // If request has name and price, use those directly
            if ($request->has('name') && $request->has('price')) {
                $wishlist[$uniqueKey] = [
                    'name' => $request->input('name'),
                    'price' => $request->input('price'),
                    'vendor_id' => $product['vendor_id'],
                    'product_id' => $productId
                ];

                // Log successful addition with frontend data
                \Illuminate\Support\Facades\Log::info('Added to wishlist with frontend data', [
                    'name' => $request->input('name'),
                    'price' => $request->input('price'),
                    'vendor_id' => $product['vendor_id'],
                    'product_id' => $productId,
                    'uniqueKey' => $uniqueKey
                ]);
            } else {
                $wishlist[$uniqueKey] = [
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'vendor_id' => $product['vendor_id'],
                    'product_id' => $productId
                ];

                // Log successful addition with backend data
                \Illuminate\Support\Facades\Log::info('Added to wishlist with backend data', [
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'vendor_id' => $product['vendor_id'],
                    'product_id' => $productId,
                    'uniqueKey' => $uniqueKey
                ]);
            }
        }

        session()->put('wishlist', $wishlist);

        return response()->json([
            'success' => true,
            'count' => count($wishlist)
        ]);
    }

    public function count()
    {
        $wishlist = session()->get('wishlist', []);
        return response()->json(['count' => count($wishlist)]);
    }

    public function view()
    {
        $wishlist = session()->get('wishlist', []);
        $originalWishlistCount = count($wishlist);

        // Filter wishlist to only show UTM Mart items (vendor_id = 1)
        $utmWishlist = [];
        foreach ($wishlist as $id => $item) {
            if (isset($item['vendor_id']) && $item['vendor_id'] == 1) {
                $utmWishlist[$id] = $item;
            }
        }

        // If there are items from other vendors, update the wishlist session
        if (count($utmWishlist) < $originalWishlistCount) {
            session()->put('wishlist', $utmWishlist);

            // Flash a message to inform the user
            session()->flash('info', 'Only UTM Mart products are shown in your wishlist. Products from other vendors have been removed.');
        }

        return view('Wishlist', ['wishlist' => $utmWishlist]);
    }

    public function index()
    {
        $wishlist = session()->get('wishlist', []);
        return view('vendor2.Wishlist', compact('wishlist'));
    }
}
