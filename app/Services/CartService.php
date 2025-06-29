<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    /**
     * Get the current cart from session
     *
     * @return array
     */
    public function getCart()
    {
        return Session::get('cart', []);
    }

    /**
     * Add a product to the cart
     *
     * @param int $productId
     * @param int $quantity
     * @return array
     */
    public function addToCart($productId, $quantity = 1)
    {
        $product = Product::find($productId);

        if (!$product) {
            return ['status' => 'error', 'message' => 'Product not found'];
        }

        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image,
                'vendor_id' => $product->vendor_id
            ];
        }

        $this->saveCart($cart);

        return [
            'status' => 'success',
            'message' => 'Product added to cart',
            'cart' => $cart
        ];
    }

    /**
     * Update cart item quantity
     *
     * @param int $productId
     * @param int $quantity
     * @return array
     */
    public function updateCartQuantity($productId, $quantity)
    {
        $cart = $this->getCart();

        if (!isset($cart[$productId])) {
            return ['status' => 'error', 'message' => 'Product not found in cart'];
        }

        if ($quantity <= 0) {
            return $this->removeFromCart($productId);
        }

        $cart[$productId]['quantity'] = $quantity;
        $this->saveCart($cart);

        return [
            'status' => 'success',
            'message' => 'Cart quantity updated',
            'cart' => $cart
        ];
    }

    /**
     * Remove a product from cart
     *
     * @param int $productId
     * @return array
     */
    public function removeFromCart($productId)
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            $this->saveCart($cart);

            return [
                'status' => 'success',
                'message' => 'Product removed from cart',
                'cart' => $cart
            ];
        }

        return ['status' => 'error', 'message' => 'Product not found in cart'];
    }

    /**
     * Clear the entire cart
     *
     * @return array
     */
    public function clearCart()
    {
        Session::forget('cart');

        return [
            'status' => 'success',
            'message' => 'Cart cleared',
            'cart' => []
        ];
    }

    /**
     * Save cart to session
     *
     * @param array $cart
     * @return void
     */
    private function saveCart($cart)
    {
        Session::put('cart', $cart);
    }

    /**
     * Calculate cart total
     *
     * @return float
     */
    public function getCartTotal()
    {
        $cart = $this->getCart();
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }
}
