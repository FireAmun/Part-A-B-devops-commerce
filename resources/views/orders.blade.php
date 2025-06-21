<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Orders - UTM Mart</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: #f8fafc;
            margin: 0;
            color: #1e293b;
        }
        .container {
            max-width: 1000px;
            margin: 2rem auto;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 2.5rem;
        }
        .header-section {
            margin-bottom: 2rem;
        }

        /* Flash message styles */
        .flash-message {
            padding: 1.25rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-weight: 600;
            font-size: 1.1rem;
            animation: fadeInDown 0.5s ease-out, pulse 2s infinite;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
        }
        .flash-success {
            background-color: #dcfce7;
            color: #166534;
            border: 2px solid #86efac;
        }
        .flash-success::before {
            content: "✓ ";
            font-weight: bold;
        }
        .flash-info {
            background-color: #e0f2fe;
            color: #0369a1;
            border: 2px solid #7dd3fc;
        }
        .flash-error {
            background-color: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fca5a5;
        }
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(22, 101, 52, 0.4);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(22, 101, 52, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(22, 101, 52, 0);
            }
        }

        .summary-cards {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .summary-card {
            background: #fff;
            border-radius: 12px;
            padding: 1.25rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }
        .summary-card h3 {
            margin: 0;
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 500;
        }
        .summary-card .value {
            font-size: 1.4rem;
            font-weight: 600;
            color: #0f172a;
            margin: 0.4rem 0;
        }
        .summary-card .trend {
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        .trend.up { color: #059669; }
        .trend.down { color: #dc2626; }
        h2 {
            color: #0f172a;
            margin-bottom: 2rem;
            font-size: 1.8rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        h2::before {
            content: '\f07a';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            color: #3b82f6;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 2rem;
            border-radius: 12px;
            overflow: hidden;
        }
        th, td {
            padding: 1.2rem 1.5rem;
            text-align: left;
        }
        th {
            background: #f1f5f9;
            color: #0f172a;
            font-weight: 600;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        td {
            border-bottom: 1px solid #e2e8f0;
            font-size: 0.95rem;
        }
        tr:last-child td {
            border-bottom: none;
        }
        tr:hover {
            background: #f8fafc;
        }
        .status {
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            display: inline-block;
        }
        .status.awaiting {
            background: #fef3c7;
            color: #92400e;
        }
        .status.confirmed {
            background: #dcfce7;
            color: #166534;
        }
        .status.ready {
            background: #dbeafe;
            color: #1e40af;
        }
        .status.cancelled {
            background: #fee2e2;
            color: #991b1b;
        }
        .no-orders {
            text-align: center;
            color: #64748b;
            padding: 4rem 0;
            background: #f8fafc;
            border-radius: 12px;
            margin: 2rem 0;
        }
        .no-orders i {
            font-size: 3rem;
            color: #94a3b8;
            margin-bottom: 1rem;
        }
        .no-orders p {
            font-size: 1.1rem;
            margin: 0;
        }
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            background: #f1f5f9;
            color: #0f172a;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            cursor: pointer;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .back-btn:hover {
            background: #e2e8f0;
            transform: translateY(-1px);
        }
        .amount {
            font-weight: 600;
            color: #0f172a;
        }
        .date {
            color: #64748b;
            font-size: 0.9rem;
        }

        .filter-section {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid #e2e8f0;
        }

        .filter-controls {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .filter-select {
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.95rem;
            background: #ffffff;
            color: #374151;
        }

        .filter-select:focus {
            outline: none;
            border-color: #3b82f6;
        }

        .filter-btn {
            background: #3b82f6;
            color: #ffffff;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
        }

        .filter-btn:hover {
            background: #2563eb;
        }

        @media (max-width: 768px) {
            .filter-controls {
                flex-direction: column;
                align-items: stretch;
            }

            .summary-cards {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .summary-card {
                padding: 1rem;
            }

            .summary-card h3 {
                font-size: 0.8rem;
            }

            .summary-card .value {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 480px) {
            .summary-cards {
                grid-template-columns: 1fr;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('home') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Vendors
        </a>

        <div class="header-section">
            <h2>Your Orders</h2>
            <p style="color: #64748b; margin-top: 0.5rem;">
                Showing orders for: <strong>{{ Auth::user()->email }}</strong>
            </p>
        </div>

        @if(session()->has('success'))
            <div class="flash-message flash-success">
                {{ session('success') }}
            </div>
        @elseif(session()->has('error'))
            <div class="flash-message flash-error">
                {{ session('error') }}
            </div>
        @elseif(session()->has('info'))
            <div class="flash-message flash-info">
                {{ session('info') }}
            </div>
        @endif

        <div class="filter-section">
            <form method="GET" action="{{ route('orders.index') }}">
                <div class="filter-controls">
                    <label for="vendor_filter">Vendor:</label>
                    <select name="vendor" id="vendor_filter" class="filter-select">
                        <option value="">All Vendors</option>
                        <option value="0" {{ request('vendor') == '0' ? 'selected' : '' }}>UTM Mart</option>
                        <option value="2" {{ request('vendor') == '2' ? 'selected' : '' }}>Setepak Printing Service</option>
                        <option value="3" {{ request('vendor') == '3' ? 'selected' : '' }}>Richiamo Caffe</option>
                    </select>

                    <label for="status_filter">Status:</label>
                    <select name="status" id="status_filter" class="filter-select">
                        <option value="">All Status</option>
                        <option value="awaiting confirmation" {{ request('status') == 'awaiting confirmation' ? 'selected' : '' }}>Awaiting Confirmation</option>
                        <option value="ready to pick" {{ request('status') == 'ready to pick' ? 'selected' : '' }}>Ready to Pick</option>
                        <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Done</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>

                    <button type="submit" class="filter-btn">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
            </form>
        </div>

        <div class="summary-cards">
            <div class="summary-card">
                <h3>Total Orders</h3>
                <div class="value">{{ $orders->count() }}</div>
                <div class="trend up">
                    <i class="fas fa-arrow-up"></i>
                    <span>{{ $orders->count() }} orders found</span>
                </div>
            </div>
            <div class="summary-card">
                <h3>Total Spent</h3>
                <div class="value">RM{{ $orders->count() > 0 ? number_format($orders->sum('amount'), 2) : '0.00' }}</div>
                <div class="trend up">
                    <i class="fas fa-arrow-up"></i>
                    <span>Your total spending</span>
                </div>
            </div>
            <div class="summary-card">
                <h3>Pending Orders</h3>
                <div class="value">{{ $orders->whereIn('order_status', ['awaiting confirmation', 'ready to pick'])->count() }}</div>
                <div class="trend down">
                    <i class="fas fa-clock"></i>
                    <span>Awaiting processing</span>
                </div>
            </div>
            <div class="summary-card">
                <h3>Cancelled Orders</h3>
                <div class="value">{{ $orders->where('order_status', 'cancelled')->count() }}</div>
                <div class="trend down">
                    <i class="fas fa-times-circle"></i>
                    <span>Cancelled by you/vendor</span>
                </div>
            </div>
            <div class="summary-card">
                <h3>Completed Orders</h3>
                <div class="value">{{ $orders->where('order_status', 'done')->count() }}</div>
                <div class="trend up">
                    <i class="fas fa-check-circle"></i>
                    <span>Successfully completed</span>
                </div>
            </div>
        </div>

        @if($orders->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Vendor</th>
                        <th>Products</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->invocie_id }}</td>
                            <td>
                                @php
                                    $vendorNames = [
                                        0 => 'UTM Mart',
                                        1 => 'UTM Mart',
                                        2 => 'Setepak Printing Service',
                                        3 => 'Richiamo Caffe'
                                    ];
                                @endphp
                                {{ $vendorNames[$order->vendor_id] ?? 'Unknown Vendor' }}
                            </td>
                            <td>
                                @php
                                    $products = is_array($order->products) ? $order->products : (is_string($order->products) ? json_decode($order->products, true) : []);
                                @endphp
                                @if(is_array($products) && count($products))
                                    <ul style="margin:0; padding-left:1.1em;">
                                        @foreach($products as $product)
                                            <li>
                                                {{ $product['name'] ?? 'Product' }}
                                                @if(isset($product['qty']))
                                                    (x{{ $product['qty'] }})
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span style="color:#aaa;">N/A</span>
                                @endif
                            </td>
                            <td class="amount">RM{{ number_format($order->amount, 2) }}</td>
                            <td>
                                <span class="status {{
                                    $order->order_status == 'awaiting confirmation' ? 'awaiting' :
                                    ($order->order_status == 'ready to pick' ? 'ready' :
                                    ($order->order_status == 'done' ? 'confirmed' :
                                    ($order->order_status == 'cancelled' ? 'cancelled' : 'rejected'))) }}">
                                    {{ ucfirst($order->order_status) }}
                                </span>
                            </td>
                            <td class="date">{{ $order->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-orders">
                <i class="fas fa-box-open"></i>
                <p>{{ request('vendor') || request('status') ? 'No orders found matching your filters.' : 'You haven\'t placed any orders yet.' }}</p>
                @if(!request('vendor') && !request('status'))
                    <p style="margin-top: 1rem; color: #64748b;">Start shopping at our vendors to see your orders here!</p>
                @endif
            </div>
        @endif
    </div>

    <script>
        // Auto-submit form when select changes
        document.getElementById('vendor_filter').addEventListener('change', function() {
            this.form.submit();
        });

        document.getElementById('status_filter').addEventListener('change', function() {
            this.form.submit();
        });

        // Auto-dismiss flash messages after 7 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const flashMessages = document.querySelectorAll('.flash-message');

            if (flashMessages.length > 0) {
                setTimeout(function() {
                    flashMessages.forEach(function(message) {
                        message.style.animation = 'fadeOut 0.5s ease-out forwards';
                        setTimeout(function() {
                            message.style.display = 'none';
                        }, 500);
                    });
                }, 7000);
            }
        });
    </script>
</body>
</html>
