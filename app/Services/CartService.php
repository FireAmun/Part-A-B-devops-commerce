<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartService
{
    /**
     * Add a product to the cart
     * 
     * @param Request $request
     * @return array
     */
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $vendorType = $request->input('vendor_type', null);
        
        Log::info('Adding to cart - request:', [
            'product_id' => $productId,
            'vendor_type' => $vendorType,
        ]);
        
        // Find product from database
        $dbProduct = Product::find($productId);
        
        if (!$dbProduct) {
            Log::error('Product not found', ['product_id' => $productId]);
            return [
                'success' => false,
                'error' => 'Product not found',
                'status' => 404
            ];
        }
        
        // Get vendor ID based on vendor type if specified
        $vendorId = $this->resolveVendorId($dbProduct->vendor_id, $vendorType);
        
        // Create unique cart key
        $uniqueKey = $vendorId . '-' . $productId;
        
        // Add to cart
        $cart = session()->get('cart', []);
        
        if (isset($cart[$uniqueKey])) {
            $cart[$uniqueKey]['qty']++;
            Log::info('Increasing quantity for existing item', ['uniqueKey' => $uniqueKey, 'new_qty' => $cart[$uniqueKey]['qty']]);
        } else {
            $cart[$uniqueKey] = [
                'name' => $dbProduct->name,
                'price' => $dbProduct->price,
                'qty' => 1,
                'vendor_id' => $vendorId,
                'product_id' => $productId
            ];
            
            // If product has an image, include it
            if (!empty($dbProduct->thumb_image)) {
                $cart[$uniqueKey]['thumb_image'] = $dbProduct->thumb_image;
            }
            
            Log::info('Adding new item to cart', ['uniqueKey' => $uniqueKey, 'item' => $cart[$uniqueKey]]);
        }
        
        session()->put('cart', $cart);
        
        return [
            'success' => true,
            'count' => $this->getCartCount($cart),
            'status' => 200
        ];
    }

    /**
     * Get count of items in cart
     *
     * @param array|null $cart
     * @return int
     */
    public function getCartCount($cart = null)
    {
        if ($cart === null) {
            $cart = session()->get('cart', []);
        }
        
        return array_sum(array_column($cart, 'qty'));
    }
    
    /**
     * Get cart contents
     *
     * @return array
     */
    public function getCart()
    {
        return session()->get('cart', []);
    }
    
    /**
     * Update cart item quantity
     *
     * @param string $id Cart item unique key
     * @param int $qty New quantity
     * @return array
     */
    public function updateCartItem($id, $qty)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            $cart[$id]['qty'] = $qty;
            session()->put('cart', $cart);
            
            return [
                'success' => true,
                'count' => $this->getCartCount($cart),
                'subtotal' => $this->calculateSubtotal($cart),
                'total' => $this->calculateTotal($cart)
            ];
        }
        
        return ['success' => false, 'message' => 'Item not found'];
    }
    
    /**
     * Remove item from cart
     *
     * @param string $id Cart item unique key
     * @return array
     */
    public function removeCartItem($id)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            
            return [
                'success' => true,
                'count' => $this->getCartCount($cart),
                'subtotal' => $this->calculateSubtotal($cart),
                'total' => $this->calculateTotal($cart)
            ];
        }
        
        return ['success' => false, 'message' => 'Item not found'];
    }
    
    /**
     * Calculate cart subtotal
     *
     * @param array|null $cart
     * @return float
     */
    public function calculateSubtotal($cart = null)
    {
        if ($cart === null) {
            $cart = session()->get('cart', []);
        }
        
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['qty'];
        }
        
        return $subtotal;
    }
    
    /**
     * Calculate cart total with discounts applied
     *
     * @param array|null $cart
     * @return float
     */
    public function calculateTotal($cart = null)
    {
        $subtotal = $this->calculateSubtotal($cart);
        
        // Simple implementation without coupon discount for now
        // In a real application, you would properly implement the coupon discount logic
        return $subtotal;
    }
    
    /**
     * Filter cart by vendor ID
     *
     * @param int $vendorId
     * @return array
     */
    public function filterCartByVendor($vendorId)
    {
        $cart = session()->get('cart', []);
        $filteredCart = [];
        
        foreach ($cart as $key => $item) {
            if (isset($item['vendor_id']) && $item['vendor_id'] == $vendorId) {
                $filteredCart[$key] = $item;
            }
        }
        
        return $filteredCart;
    }
    
    /**
     * Resolve vendor ID based on vendor type
     *
     * @param int $defaultVendorId
     * @param string|null $vendorType
     * @return int
     */
    private function resolveVendorId($defaultVendorId, $vendorType = null)
    {
        if ($vendorType) {
            switch ($vendorType) {
                case 'utm':
                    return 1; // UTM Mart
                case 'vendor2':
                case 'richiamo':
                    return 2; // Richiamo Caffe
                case 'vendor3':
                case 'print':
                    return 3; // Setepak Printing
            }
        }
        
        return $defaultVendorId;
    }
}
