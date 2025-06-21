<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Check Out - Richiamo Caffe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #8B4513;
            --primary-dark: #654321;
            --secondary: #A0522D;
            --accent: #D2691E;
            --success: #059669;
            --danger: #dc2626;
            --text: #2F1B14;
            --text-light: #6b4a2d;
            --white: #ffffff;
            --cream: #F5F5DC;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --shadow-sm: 0 1px 2px 0 rgb(139 69 19 / 0.05);
            --shadow: 0 4px 6px -1px rgb(139 69 19 / 0.1), 0 2px 4px -2px rgb(139 69 19 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(139 69 19 / 0.1), 0 4px 6px -4px rgb(139 69 19 / 0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, var(--cream), var(--white));
            margin: 0;
            padding: 0;
            min-height: 100vh;
            color: var(--text);
            line-height: 1.5;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 2rem;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        .cart-section, .summary-section {
            background: var(--white);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 2rem;
            transition: var(--transition);
        }

        .cart-section:hover, .summary-section:hover {
            box-shadow: var(--shadow-lg);
        }

        h2 {
            color: var(--primary-dark);
            margin-bottom: 1.5rem;
            font-size: 1.75rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .cart-section h2::before {
            content: '\f0f4';
            font-family: 'Font Awesome 6 Free';
            color: var(--primary);
        }

        .summary-section h2::before {
            content: '\f02e';
            font-family: 'Font Awesome 6 Free';
            color: var(--primary);
        }

        .cart-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 1.5rem;
        }

        .cart-table th,
        .cart-table td {
            padding: 1.25rem 1rem;
            text-align: left;
        }

        .cart-table th {
            background: var(--cream);
            font-weight: 600;
            color: var(--text);
            border-bottom: 2px solid var(--gray-200);
        }

        .cart-table td {
            border-bottom: 1px solid var(--gray-200);
        }

        .cart-table tr:last-child td {
            border-bottom: none;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        .product-image {
            width: 100px;
            height: 100px;
            border-radius: 12px;
            object-fit: cover;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }

        .product-image:hover {
            transform: scale(1.05);
        }

        .product-name {
            font-weight: 500;
            color: var(--text);
            font-size: 1.1rem;
        }

        .quantity-display {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--cream);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            color: var(--text);
            border: 1px solid var(--gray-200);
        }

        .remove-btn {
            background: #fee2e2;
            color: var(--danger);
            border: none;
            padding: 0.75rem 1.25rem;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .remove-btn:hover {
            background: #fecaca;
            transform: translateY(-2px);
        }

        .coupon-section {
            margin: 2rem 0;
            padding: 1.75rem;
            background: var(--cream);
            border-radius: 12px;
            border: 1px solid var(--gray-200);
        }

        .coupon-section h3 {
            color: var(--text);
            margin-bottom: 1rem;
            font-size: 1.25rem;
        }

        .coupon-form {
            display: flex;
            gap: 1rem;
        }

        .coupon-input {
            flex: 1;
            padding: 0.875rem 1rem;
            border: 2px solid var(--gray-200);
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
            background: var(--white);
        }

        .coupon-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .apply-btn {
            background: var(--primary);
            color: var(--white);
            border: none;
            padding: 0.875rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .apply-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            color: var(--text-light);
            font-size: 1.1rem;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px solid var(--gray-200);
            font-weight: 600;
            font-size: 1.25rem;
            color: var(--text);
        }

        .checkout-btn {
            width: 100%;
            background: var(--primary);
            color: var(--white);
            border: none;
            padding: 1.25rem;
            border-radius: 12px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 600;
            font-size: 1.1rem;
            margin-top: 2rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .checkout-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .discount {
            color: var(--success);
            font-weight: 500;
        }

        .toast {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: var(--primary);
            color: var(--white);
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transform: translateY(100px);
            opacity: 0;
            transition: var(--transition);
            z-index: 1000;
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        .toast i {
            font-size: 1.25rem;
        }

        .empty-cart {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-light);
        }

        .empty-cart i {
            font-size: 5rem;
            margin-bottom: 1.5rem;
            color: var(--gray-300);
        }

        .empty-cart h3 {
            font-size: 1.5rem;
            color: var(--text);
            margin-bottom: 1rem;
        }

        .empty-cart p {
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }

        .continue-shopping {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            background: var(--primary);
            color: var(--white);
            padding: 1rem 2rem;
            border-radius: 12px;
            text-decoration: none;
            transition: var(--transition);
            font-weight: 500;
            font-size: 1.1rem;
        }

        .continue-shopping:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            background: var(--gray-100);
            color: var(--primary-dark);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.25rem;
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
            text-decoration: none;
        }

        .back-btn:hover {
            background: var(--gray-200);
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
                padding: 1rem;
                margin: 20px auto;
            }

            .cart-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .coupon-form {
                flex-direction: column;
            }

            .product-info {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .product-image {
                width: 140px;
                height: 140px;
            }

            .cart-section, .summary-section {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="cart-section">
            <a href="{{ route('vendor2.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Richiamo Caffe
            </a>
            <h2>Your Coffee Order</h2>
            @if(session('success'))
                <div class="toast show">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="toast show">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if(count($cart) > 0)
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($cart as $id => $item)
                            <tr>
                                <td>
                                    <div class="product-info">
                                        @php
                                            // Extract product ID from composite key (vendor_id-product_id) or use as is
                                            $actualProductId = isset($item['product_id']) ? $item['product_id'] : (strpos($id, '-') !== false ? explode('-', $id)[1] : $id);
                                            $vendorId = isset($item['vendor_id']) ? $item['vendor_id'] : (strpos($id, '-') !== false ? explode('-', $id)[0] : 3);

                                            // For Richiamo products, use caffe images based on product name
                                            $productName = strtolower($item['name']);
                                            $imageName = str_replace(' ', '-', $productName) . '.png';
                                            $imagePath = asset('images/caffe/' . $imageName);
                                        @endphp
                                        <img src="{{ $imagePath }}" alt="{{ $item['name'] }}" class="product-image" onerror="this.src='{{ asset('images/caffe/espresso.png') }}'">
                                        <span class="product-name">{{ $item['name'] }}</span>
                                    </div>
                                </td>
                                <td>RM{{ number_format($item['price'], 2) }}</td>
                                <td>
                                    <div class="quantity-display">
                                        {{ $item['qty'] }}
                                    </div>
                                </td>
                                <td>RM{{ number_format($item['price'] * $item['qty'], 2) }}</td>
                                <td>
                                    <form method="POST" action="{{ route('cart.remove') }}" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ isset($item['product_id']) ? $item['product_id'] : (strpos($id, '-') !== false ? explode('-', $id)[1] : $id) }}">
                                        <button type="submit" class="remove-btn">
                                            <i class="fas fa-trash"></i>
                                            Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @php $total += $item['price'] * $item['qty']; @endphp
                        @endforeach
                    </tbody>
                </table>

                <div class="coupon-section">
                    <h3><i class="fas fa-percent"></i> Apply Coupon</h3>
                    <form method="POST" action="{{ route('checkout.applyCoupon') }}" class="coupon-form">
                        @csrf
                        <input type="text" name="coupon_code" placeholder="Enter coupon code" class="coupon-input">
                        <button type="submit" class="apply-btn">
                            <i class="fas fa-tag"></i>
                            Apply Coupon
                        </button>
                    </form>
                </div>
            @else
                <div class="empty-cart">
                    <i class="fas fa-mug-hot"></i>
                    <h3>Your coffee cart is empty</h3>
                    <p>Looks like you haven't ordered any delicious coffee yet.</p>
                    <a href="{{ route('vendor2.index') }}" class="continue-shopping">
                        <i class="fas fa-arrow-left"></i>
                        Continue Shopping
                    </a>
                </div>
            @endif
        </div>

        @if(count($cart) > 0)
            <div class="summary-section">
                <h2>Order Summary</h2>
                <div class="summary-item">
                    <span>Subtotal</span>
                    <span>RM{{ number_format($total, 2) }}</span>
                </div>
                @if(session('coupon'))
                    @php
                        $discount = session('coupon')->discount_type == 'percent'
                            ? $total * (session('coupon')->discount / 100)
                            : session('coupon')->discount;
                        $totalAfterDiscount = $total - $discount;
                    @endphp
                    <div class="summary-item">
                        <span>Coupon ({{ session('coupon')->code }})</span>
                        <span class="discount">-RM{{ number_format($discount, 2) }}</span>
                    </div>
                @endif
                <div class="summary-total">
                    <span>Total</span>
                    <span>RM{{ number_format($totalAfterDiscount ?? $total, 2) }}</span>
                </div>
                <button class="checkout-btn" onclick="window.location='{{ route('vendor2.checkout.confirmation') }}'">
                    <i class="fas fa-coffee"></i>
                    Place Coffee Order
                </button>
            </div>
        @endif
    </div>

    <script>
        // Clear cart when navigating to different vendor
        document.addEventListener('DOMContentLoaded', function() {
            // Check if cart clearing has already been done
            const key = 'richiamo_cart_cleared_' + new Date().toISOString().split('T')[0];
            if (!sessionStorage.getItem(key)) {
                // Mark that we're clearing the cart for today
                sessionStorage.setItem(key, 'true');

                // Check if this is a vendor2 cart page and clear non-vendor2 items
                fetch('{{ route('cart.clearOtherVendors') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({vendor: 'richiamo'})
                })
                .then(response => response.json())
                .then(data => {
                    // Only refresh if items were actually cleared and cart is empty now
                    if (document.querySelectorAll('.cart-table tbody tr').length === 0) {
                    if (data.success && data.count !== {{ count($cart) }}) {
                        window.location.reload();
                    }
                });
            }
        });

        // Clear the flag when leaving the page
        window.addEventListener('beforeunload', function() {
            sessionStorage.removeItem('vendor2_cart_cleared');
        });

        // Auto-hide toast messages
        document.addEventListener('DOMContentLoaded', function() {
            const toasts = document.querySelectorAll('.toast');
            toasts.forEach(toast => {
                setTimeout(() => {
                    toast.classList.remove('show');
                }, 3000);
            });
        });
    </script>
</body>
</html>
