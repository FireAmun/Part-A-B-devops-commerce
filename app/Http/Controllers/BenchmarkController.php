<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Services\CartService;

class BenchmarkController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function runBenchmark()
    {
        // Clear any existing cart data
        session()->forget('cart');

        $results = [
            'original' => [],
            'refactored' => []
        ];

        // Run each test multiple times to get an average
        $iterations = 10;

        // Test the original approach (simulated)
        $originalTimes = [];
        for ($i = 0; $i < $iterations; $i++) {
            $start = microtime(true);

            // Simulate original cart adding logic
            $this->simulateOriginalCartAdd();

            $end = microtime(true);
            $originalTimes[] = ($end - $start) * 1000; // Convert to milliseconds

            // Clear cart for next iteration
            session()->forget('cart');
        }

        // Calculate stats for original approach
        $results['original'] = [
            'min' => min($originalTimes),
            'max' => max($originalTimes),
            'avg' => array_sum($originalTimes) / count($originalTimes)
        ];

        // Clear any existing cart data
        session()->forget('cart');

        // Test the refactored approach
        $refactoredTimes = [];
        for ($i = 0; $i < $iterations; $i++) {
            $start = microtime(true);

            // Use the refactored CartService
            $this->simulateRefactoredCartAdd();

            $end = microtime(true);
            $refactoredTimes[] = ($end - $start) * 1000; // Convert to milliseconds

            // Clear cart for next iteration
            session()->forget('cart');
        }

        // Calculate stats for refactored approach
        $results['refactored'] = [
            'min' => min($refactoredTimes),
            'max' => max($refactoredTimes),
            'avg' => array_sum($refactoredTimes) / count($refactoredTimes)
        ];

        // Calculate improvement
        $improvement = ($results['original']['avg'] - $results['refactored']['avg']) / $results['original']['avg'] * 100;

        return view('benchmark-results', [
            'results' => $results,
            'improvement' => $improvement,
            'iterations' => $iterations
        ]);
    }

    private function simulateOriginalCartAdd()
    {
        // Simulate the original add to cart logic with hard-coded products
        $productId = 1;
        $vendorType = 'utm';

        // Define UTM Mart products (vendor_id = 1) - just like in the original controller
        $utmMartProducts = [
            1 => ['name' => 'UTM Shirt', 'price' => 25.00, 'vendor_id' => 1],
            2 => ['name' => 'UTM Cup', 'price' => 15.00, 'vendor_id' => 1],
            3 => ['name' => 'UTM Books', 'price' => 40.00, 'vendor_id' => 1],
        ];

        $product = null;
        $vendor_id = null;

        // Check first if the product exists in the database
        $dbProduct = Product::find($productId);
        if ($dbProduct) {
            $product = [
                'name' => $dbProduct->name,
                'price' => $dbProduct->price,
                'vendor_id' => $dbProduct->vendor_id,
            ];
            $vendor_id = $dbProduct->vendor_id;

            if ($vendorType == 'utm' && $vendor_id != 1) {
                $vendor_id = 1;
            }
        } else if ($vendorType) {
            switch ($vendorType) {
                case 'utm':
                    $vendor_id = 1;
                    if (isset($utmMartProducts[$productId])) {
                        $product = $utmMartProducts[$productId];
                    }
                    break;
            }
        } else {
            if ($productId >= 1 && $productId <= 3) {
                if (isset($utmMartProducts[$productId])) {
                    $product = $utmMartProducts[$productId];
                    $vendor_id = 1;
                }
            }
        }

        if (!$product) {
            return;
        }

        // Ensure vendor ID is set correctly
        $product['vendor_id'] = $vendor_id ?: $product['vendor_id'];

        // Create a unique key for this product combining vendor and product ID
        $uniqueKey = $product['vendor_id'] . '-' . $productId;

        $cart = session()->get('cart', []);

        if (isset($cart[$uniqueKey])) {
            $cart[$uniqueKey]['qty']++;
        } else {
            $cart[$uniqueKey] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'qty' => 1,
                'vendor_id' => $product['vendor_id'],
                'product_id' => $productId
            ];
        }

        session()->put('cart', $cart);
    }

    private function simulateRefactoredCartAdd()
    {
        // Create a request object with the same parameters
        $request = new Request([
            'product_id' => 1,
            'vendor_type' => 'utm'
        ]);

        // Use the refactored CartService
        $this->cartService->addToCart($request);
    }
}
