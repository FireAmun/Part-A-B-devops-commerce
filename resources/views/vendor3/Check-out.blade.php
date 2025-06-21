<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Check Out - Setepak Printing Service KTF</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #16a34a;
            --primary-dark: #15803d;
            --secondary: #22c55e;
            --accent: #86efac;
            --success: #059669;
            --danger: #dc2626;
            --text: #064e3b;
            --text-light: #059669;
            --white: #ffffff;
            --light-green: #f0fdf4;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --shadow-sm: 0 1px 2px 0 rgb(22 163 74 / 0.05);
            --shadow: 0 4px 6px -1px rgb(22 163 74 / 0.1), 0 2px 4px -2px rgb(22 163 74 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(22 163 74 / 0.1), 0 4px 6px -4px rgb(22 163 74 / 0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, var(--light-green), var(--white));
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
            content: '\f02f';
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
            background: var(--light-green);
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

        .product-icon {
            width: 100px;
            height: 100px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--light-green);
            color: var(--primary);
            font-size: 2.5rem;
            box-shadow: var(--shadow-sm);
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
            background: var(--light-green);
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

        .upload-section {
            margin: 2rem 0;
            padding: 1.75rem;
            background: var(--light-green);
            border-radius: 12px;
            border: 1px solid var(--gray-200);
        }

        .upload-section h3 {
            color: var(--text);
            margin-bottom: 1rem;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .upload-section h3::before {
            content: '\f093';
            font-family: 'Font Awesome 6 Free';
            color: var(--primary);
        }

        .file-upload {
            position: relative;
            display: inline-block;
            cursor: pointer;
            width: 100%;
        }

        .file-upload input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .file-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 1.5rem;
            border: 2px dashed var(--primary);
            border-radius: 12px;
            background: var(--white);
            color: var(--primary);
            font-weight: 500;
            transition: var(--transition);
            cursor: pointer;
        }

        .file-upload-label:hover {
            background: var(--light-green);
            border-color: var(--primary-dark);
        }

        .file-upload-label i {
            font-size: 1.5rem;
        }

        .coupon-section {
            margin: 2rem 0;
            padding: 1.75rem;
            background: var(--light-green);
            border-radius: 12px;
            border: 1px solid var(--gray-200);
        }

        .coupon-section h3 {
            color: var(--text);
            margin-bottom: 1rem;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
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
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
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

            .product-icon {
                width: 80px;
                height: 80px;
                font-size: 2rem;
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
            <a href="{{ route('vendor3.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Setepak Printing
            </a>
            <h2>Your Printing Order</h2>

            @if(count($cart) > 0)
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Service</th>
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
                                            $productName = strtolower($item['name']);
                                            $iconClass = 'fas fa-print'; // Default icon

                                            if (str_contains($productName, 'business card')) {
                                                $iconClass = 'fas fa-id-card';
                                            } elseif (str_contains($productName, 'banner')) {
                                                $iconClass = 'fas fa-flag';
                                            } elseif (str_contains($productName, 'sticker') || str_contains($productName, 'label')) {
                                                $iconClass = 'fas fa-tags';
                                            } elseif (str_contains($productName, 'flyer')) {
                                                $iconClass = 'fas fa-file-pdf';
                                            } elseif (str_contains($productName, 'brochure')) {
                                                $iconClass = 'fas fa-book-open';
                                            } elseif (str_contains($productName, 'photocopy')) {
                                                $iconClass = 'fas fa-copy';
                                            } elseif (str_contains($productName, 't-shirt')) {
                                                $iconClass = 'fas fa-tshirt';
                                            } elseif (str_contains($productName, 'packaging')) {
                                                $iconClass = 'fas fa-box';
                                            } elseif (str_contains($productName, 'a4') || str_contains($productName, 'a3')) {
                                                $iconClass = 'fas fa-file-alt';
                                            }
                                        @endphp
                                        <div class="product-icon">
                                            <i class="{{ $iconClass }}"></i>
                                        </div>
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
                                        <input type="hidden" name="product_id" value="{{ $id }}">
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
                    <i class="fas fa-print"></i>
                    <h3>Your printing cart is empty</h3>
                    <p>Looks like you haven't selected any printing services yet.</p>
                    <a href="{{ route('vendor3.index') }}" class="continue-shopping">
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
                <div class="summary-total">
                    <span>Total</span>
                    <span>RM{{ number_format($total, 2) }}</span>
                </div>
                <button class="checkout-btn" onclick="window.location='{{ route('vendor3.checkout.confirmation') }}'">
                    <i class="fas fa-print"></i>
                    Place Printing Order
                </button>
            </div>
        @endif
    </div>

    <script>
        // File upload handling
        document.getElementById('print_file').addEventListener('change', function(e) {
            const label = document.querySelector('.file-upload-label span');
            if (e.target.files.length > 0) {
                const fileName = e.target.files[0].name;
                label.textContent = `Selected: ${fileName}`;
                label.parentElement.style.borderColor = '#059669';
                label.parentElement.style.background = '#f0fdf4';
            } else {
                label.textContent = 'Click to upload your files or drag and drop';
                label.parentElement.style.borderColor = '#16a34a';
                label.parentElement.style.background = '#ffffff';
            }
        });

        // Drag and drop functionality
        const fileUpload = document.querySelector('.file-upload-label');

        fileUpload.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.style.borderColor = '#059669';
            this.style.background = '#f0fdf4';
        });

        fileUpload.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.style.borderColor = '#16a34a';
            this.style.background = '#ffffff';
        });

        fileUpload.addEventListener('drop', function(e) {
            e.preventDefault();
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                document.getElementById('print_file').files = files;
                document.getElementById('print_file').dispatchEvent(new Event('change'));
            }
        });
    </script>
</body>
</html>
