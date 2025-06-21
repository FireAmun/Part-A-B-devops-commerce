<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Setepak Printing Service KTF Dashboard</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, #f0fdf4, #ffffff);
            margin: 0;
            padding: 0;
            color: #064e3b;
        }
        .layout {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 64px;
            background: #16a34a;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1.2rem 0 1rem 0;
            gap: 2rem;
            box-shadow: 2px 0 8px rgba(22,163,74,0.15);
            z-index: 20;
        }
        .sidebar .logo {
            font-size: 1.7rem;
            margin-bottom: 2rem;
            color: #fff;
        }
        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            width: 100%;
            align-items: center;
        }
        .sidebar-nav a {
            color: #fff;
            text-decoration: none;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 10px;
            transition: background 0.2s, color 0.2s;
            position: relative;
        }
        .sidebar-nav a.active, .sidebar-nav a:hover {
            background: #22c55e;
            color: #86efac;
        }
        .sidebar-nav a .tooltip {
            visibility: hidden;
            opacity: 0;
            background: #064e3b;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 0.3rem 0.8rem;
            position: absolute;
            left: 110%;
            top: 50%;
            transform: translateY(-50%);
            white-space: nowrap;
            font-size: 0.95rem;
            z-index: 100;
            transition: opacity 0.2s, visibility 0.2s;
        }
        .sidebar-nav a:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }
        .main-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }
        .header {
            background: #16a34a;
            color: #fff;
            padding: 0.8rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(22,163,74,0.15);
            z-index: 10;
        }
        .header form button {
            background: none;
            border: none;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            transition: color 0.2s;
        }
        .header form button:hover {
            color: #86efac;
        }
        .main-content {
            padding: 2.5rem 2rem 2rem 2rem;
            min-height: 100vh;
            background: linear-gradient(135deg, #f0fdf4, #ffffff);
        }
        .container {
            max-width: 1400px;
            min-width: 1100px;
            margin: 3.5rem auto 3.5rem auto;
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(22,163,74,0.13);
            padding: 3.5rem 3rem 3rem 3rem;
            border: 1px solid #f0fdf4;
        }
        h1 {
            color: #15803d;
            margin-bottom: 2rem;
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }
        h1::before {
            content: '\f02f';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            color: #16a34a;
            font-size: 1.3rem;
        }
        // ...existing styles from vendor2 dashboard but with green color scheme...
        .filter-form {
            margin-bottom: 1.5rem;
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        .filter-form label {
            font-weight: 500;
            color: #15803d;
        }
        .filter-form select {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            font-size: 1rem;
            background: #f0fdf4;
            color: #064e3b;
            transition: border 0.2s;
        }
        .filter-form select:focus {
            border: 1.5px solid #16a34a;
            outline: none;
        }
        .orders-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 18px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 2px 8px rgba(22,163,74,0.08);
        }
        th, td {
            padding: 0.7rem 0.7rem;
            text-align: left;
            font-size: 1.02rem;
            vertical-align: top;
        }
        th {
            background: #f0fdf4;
            color: #15803d;
            font-weight: 700;
            font-size: 1.08rem;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            border-bottom: 2px solid #e5e7eb;
        }
        td {
            border-bottom: 1px solid #e5e7eb;
            font-size: 1rem;
        }
        tr:last-child td {
            border-bottom: none;
        }
        tr:hover {
            background: #fefbf5;
        }
        .status {
            font-weight: 600;
            padding: 0.5rem 1.1rem;
            border-radius: 20px;
            font-size: 0.92rem;
            display: inline-block;
        }
        .status.awaiting {
            background: #fef3c7;
            color: #92400e;
        }
        .status.confirmed, .status.done {
            background: #dcfce7;
            color: #166534;
        }
        .status.rejected {
            background: #fee2e2;
            color: #991b1b;
        }
        .status.ready {
            background: #f0fdf4;
            color: #16a34a;
        }
        .status.cancelled {
            background: #fee2e2;
            color: #991b1b;
        }
        .amount {
            font-weight: 600;
            color: #064e3b;
        }
        .date {
            color: #059669;
            font-size: 0.97rem;
        }
        .proof-link {
            color: #16a34a;
            text-decoration: underline;
            font-size: 0.98rem;
        }
        .status-form {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }
        .status-form select {
            padding: 0.35rem 0.7rem;
            border-radius: 7px;
            border: 1px solid #e5e7eb;
            font-size: 0.97rem;
            background: #f0fdf4;
            color: #064e3b;
        }
        .status-form button {
            background: #16a34a;
            color: #fff;
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.97rem;
            transition: background 0.2s;
        }
        .status-form button:hover {
            background: #15803d;
        }
        .no-orders {
            text-align: center;
            color: #059669;
            padding: 4rem 0;
            background: #f0fdf4;
            border-radius: 12px;
            margin: 2rem 0;
        }
        .no-orders i {
            font-size: 3rem;
            color: #22c55e;
            margin-bottom: 1rem;
        }
        .no-orders p {
            font-size: 1.1rem;
            margin: 0;
        }
        .footer {
            background: #16a34a;
            color: #fff;
            text-align: center;
            padding: 1.2rem 0 1rem 0;
            margin-top: 3rem;
            font-size: 1rem;
            letter-spacing: 0.5px;
        }
        .products-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4em;
        }
        .product-badge {
            background: #f0fdf4;
            color: #15803d;
            border-radius: 8px;
            padding: 0.25em 0.7em;
            font-size: 0.97em;
            font-weight: 500;
            margin-bottom: 0.2em;
            display: inline-block;
            border: 1px solid #e5e7eb;
        }
        @media (max-width: 1100px) {
            .container { padding: 1.2rem; min-width: 0; }
        }
        @media (max-width: 900px) {
            .main-content { padding: 1.5rem 0.5rem; }
            .container { padding: 0.7rem; min-width: 0; }
            .layout { flex-direction: column; }
            .sidebar { flex-direction: row; width: 100vw; height: 60px; min-height: 0; padding: 0.5rem 0; }
            .sidebar .logo { margin-bottom: 0; }
            .sidebar-nav { flex-direction: row; gap: 1.2rem; }
        }
        @media (max-width: 700px) {
            .container { padding: 0.3rem; min-width: 0; }
            th, td { padding: 0.6rem 0.3rem; font-size: 0.93rem; }
            h1 { font-size: 1.1rem; }
        }
    </style>
</head>
<body>
    <div class="layout">
        <div class="sidebar">
            <div class="logo" title="Setepak Printing Service KTF"><i class="fas fa-print"></i></div>
            <nav class="sidebar-nav">
                <a href="{{ route('vendor.dashboard.setepak') }}" class="active" title="Printing Orders">
                    <i class="fas fa-file-text"></i>
                    <span class="tooltip">Printing Orders</span>
                </a>
                <a href="#analytics-section" title="Analytics" onclick="toggleSection('analytics')">
                    <i class="fas fa-chart-bar"></i>
                    <span class="tooltip">Analytics</span>
                </a>
                <a href="#products-section" title="Products" onclick="toggleSection('products')">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="tooltip">Products</span>
                </a>
                <a href="#complaints-section" title="Complaints" onclick="toggleSection('complaints')">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span class="tooltip">Complaints</span>
                </a>
                <a href="#settings-section" title="Settings" onclick="toggleSection('settings')">
                    <i class="fas fa-cog"></i>
                    <span class="tooltip">Settings</span>
                </a>
            </nav>
        </div>
        <div class="main-section">
            <div class="header">
                <span>Setepak Printing Service KTF Dashboard</span>
                <form method="POST" action="{{ route('vendor.logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
            <div class="main-content">
                <div class="container">
                    <!-- Orders Section -->
                    <div id="orders-content">
                        <h1 id="orders-section">Printing Orders</h1>
                        <form method="GET" class="filter-form">
                            <label for="status">Filter by Status:</label>
                            <select name="status" id="status" onchange="this.form.submit()">
                                <option value="">All Orders</option>
                                <option value="awaiting confirmation" {{ (isset($status) && $status == 'awaiting confirmation') ? 'selected' : '' }}>Awaiting Confirmation</option>
                                <option value="ready to pick" {{ (isset($status) && $status == 'ready to pick') ? 'selected' : '' }}>Ready to Pick</option>
                                <option value="done" {{ (isset($status) && $status == 'done') ? 'selected' : '' }}>Done</option>
                                <option value="cancelled" {{ (isset($status) && $status == 'cancelled') ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </form>

                        <table class="orders-table">
                            <thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Customer</th>
                                    <th>Contact</th>
                                    <th>Services</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Files</th>
                                    <th>Ordered At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr>
                                    <td>{{ $order->invocie_id }}</td>
                                    <td>
                                        <div>{{ $order->user_name }}</div>
                                        @if($order->user_email)
                                            <div style="font-size: 0.85rem; color: #059669;">{{ $order->user_email }}</div>
                                        @endif
                                    </td>
                                    <td>{{ $order->user_phone }}</td>
                                    <td>
                                        @php
                                            $products = is_array($order->products) ? $order->products : (is_string($order->products) ? json_decode($order->products, true) : []);
                                        @endphp
                                        @if(is_array($products) && count($products))
                                            <div class="products-list">
                                                @foreach($products as $product)
                                                    <span class="product-badge">
                                                        {{ $product['name'] ?? 'Service' }}
                                                        @if(isset($product['qty']))
                                                            (x{{ $product['qty'] }})
                                                        @endif
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span style="color:#aaa;">N/A</span>
                                        @endif
                                        @if($order->notes)
                                            <div style="margin-top: 0.5rem; font-size: 0.85rem; color: #059669; font-style: italic;">
                                                <strong>Notes:</strong> {{ $order->notes }}
                                            </div>
                                        @endif
                                    </td>

                                    <td class="amount">{{ $order->currency_icon }} {{ number_format($order->amount, 2) }}</td>
                                    <td class="status
                                        {{ $order->order_status == 'awaiting confirmation' ? 'awaiting' :
                                           ($order->order_status == 'ready to pick' ? 'ready' :
                                           ($order->order_status == 'done' ? 'confirmed' :
                                           ($order->order_status == 'cancelled' ? 'cancelled' : 'rejected'))) }}">
                                    {{ ucfirst($order->order_status) }}
                                    </td>
                                    <td>
                                        <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                                            @if($order->payment_proof)
                                                <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="proof-link">
                                                    <i class="fas fa-receipt"></i> Payment
                                                </a>
                                            @endif
                                            @if($order->print_file)
                                                <a href="{{ asset('storage/' . $order->print_file) }}" target="_blank" class="proof-link">
                                                    <i class="fas fa-file"></i> Print File
                                                </a>
                                            @endif
                                            @if(!$order->payment_proof && !$order->print_file)
                                                <span style="color:#aaa;">N/A</span>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="date">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('vendor.dashboard.setepak.order.status', $order->id) }}" class="status-form">
                                            @csrf
                                            <select name="order_status" required>
                                                <option value="awaiting confirmation" {{ $order->order_status == 'awaiting confirmation' ? 'selected' : '' }}>Awaiting Confirmation</option>
                                                <option value="ready to pick" {{ $order->order_status == 'ready to pick' ? 'selected' : '' }}>Ready to Pick</option>
                                                <option value="done" {{ $order->order_status == 'done' ? 'selected' : '' }}>Done</option>
                                                <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                            <button type="submit">Update</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9">
                                        <div class="no-orders">
                                            <i class="fas fa-print"></i>
                                            <p>No printing orders yet.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Analytics Section -->
                    <div id="analytics-content" style="display: none;">
                        <h1>Printing Service Analytics</h1>

                        <div class="analytics-filters" style="background: #f0fdf4; padding: 1.5rem; border-radius: 12px; margin-bottom: 2rem;">
                            <form method="GET" id="analytics-form" style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
                                <label for="period" style="font-weight: 500; color: #15803d;">Time Period:</label>
                                <select name="period" id="period" style="padding: 0.5rem 1rem; border-radius: 8px; border: 1px solid #e5e7eb; background: white;">
                                    <option value="7">Last 7 Days</option>
                                    <option value="30">Last 30 Days</option>
                                    <option value="90">Last 3 Months</option>
                                    <option value="365">Last Year</option>
                                </select>
                                <button type="button" onclick="updateAnalytics()" style="background: #16a34a; color: white; border: none; padding: 0.5rem 1rem; border-radius: 8px; cursor: pointer;">
                                    <i class="fas fa-sync"></i> Update
                                </button>
                            </form>
                        </div>

                        <div class="analytics-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                            <div class="analytics-card" style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 8px rgba(22,163,74,0.08);">
                                <h3 style="color: #15803d; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                                    <i class="fas fa-dollar-sign"></i> Total Revenue
                                </h3>
                                <div class="metric-value" style="font-size: 2rem; font-weight: 700; color: #059669;">RM{{ number_format($orders->sum('amount'), 2) }}</div>
                                <div class="metric-change" style="color: #059669; font-size: 0.9rem;">
                                    <i class="fas fa-arrow-up"></i> +18.4% from last period
                                </div>
                            </div>

                            <div class="analytics-card" style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 8px rgba(22,163,74,0.08);">
                                <h3 style="color: #15803d; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                                    <i class="fas fa-print"></i> Print Jobs
                                </h3>
                                <div class="metric-value" style="font-size: 2rem; font-weight: 700; color: #16a34a;">{{ $orders->count() }}</div>
                                <div class="metric-change" style="color: #059669; font-size: 0.9rem;">
                                    <i class="fas fa-arrow-up"></i> +14.2% from last period
                                </div>
                            </div>

                            <div class="analytics-card" style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 8px rgba(22,163,74,0.08);">
                                <h3 style="color: #15803d; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                                    <i class="fas fa-chart-line"></i> Avg. Job Value
                                </h3>
                                <div class="metric-value" style="font-size: 2rem; font-weight: 700; color: #f59e0b;">RM{{ $orders->count() > 0 ? number_format($orders->sum('amount') / $orders->count(), 2) : '0.00' }}</div>
                                <div class="metric-change" style="color: #059669; font-size: 0.9rem;">
                                    <i class="fas fa-arrow-up"></i> +6.7% from last period
                                </div>
                            </div>

                            <div class="analytics-card" style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 8px rgba(22,163,74,0.08);">
                                <h3 style="color: #15803d; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                                    <i class="fas fa-tasks"></i> Completion Rate
                                </h3>
                                <div class="metric-value" style="font-size: 2rem; font-weight: 700; color: #059669;">{{ $orders->count() > 0 ? round(($orders->where('order_status', 'done')->count() / $orders->count()) * 100, 1) : 0 }}%</div>
                                <div class="metric-change" style="color: #059669; font-size: 0.9rem;">
                                    <i class="fas fa-arrow-up"></i> +9.1% from last period
                                </div>
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                            <div class="chart-container" style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 8px rgba(22,163,74,0.08);">
                                <h3 style="color: #15803d; margin-bottom: 1rem;">Daily Printing Revenue</h3>
                                <canvas id="salesChart" width="400" height="200"></canvas>
                            </div>

                            <div class="status-breakdown" style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 8px rgba(22,163,74,0.08);">
                                <h3 style="color: #15803d; margin-bottom: 1rem;">Job Status</h3>
                                <div class="status-list">
                                    @php
                                        $statusCounts = [
                                            'awaiting confirmation' => $orders->where('order_status', 'awaiting confirmation')->count(),
                                            'ready to pick' => $orders->where('order_status', 'ready to pick')->count(),
                                            'done' => $orders->where('order_status', 'done')->count(),
                                            'cancelled' => $orders->where('order_status', 'cancelled')->count(),
                                        ];
                                    @endphp
                                    @foreach($statusCounts as $status => $count)
                                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid #e5e7eb;">
                                            <span class="status {{
                                                $status == 'awaiting confirmation' ? 'awaiting' :
                                                ($status == 'ready to pick' ? 'ready' :
                                                ($status == 'done' ? 'confirmed' :
                                                ($status == 'cancelled' ? 'cancelled' : 'rejected'))) }}" style="font-size: 0.8rem;">
                                                {{ ucfirst($status) }}
                                            </span>
                                            <span style="font-weight: 600;">{{ $count }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="top-products" style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 8px rgba(22,163,74,0.08);">
                            <h3 style="color: #15803d; margin-bottom: 1rem;">Popular Services</h3>
                            <div style="overflow-x: auto;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                        <tr style="border-bottom: 2px solid #e5e7eb;">
                                            <th style="text-align: left; padding: 0.75rem; color: #15803d;">Service</th>
                                            <th style="text-align: left; padding: 0.75rem; color: #15803d;">Jobs</th>
                                            <th style="text-align: left; padding: 0.75rem; color: #15803d;">Revenue</th>
                                            <th style="text-align: left; padding: 0.75rem; color: #15803d;">Avg. Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $productStats = [];
                                            foreach($orders as $order) {
                                                $products = is_array($order->products) ? $order->products : (is_string($order->products) ? json_decode($order->products, true) : []);
                                                if(is_array($products)) {
                                                    foreach($products as $product) {
                                                        $name = $product['name'] ?? 'Unknown Service';
                                                        if(!isset($productStats[$name])) {
                                                            $productStats[$name] = ['orders' => 0, 'revenue' => 0, 'qty' => 0];
                                                        }
                                                        $productStats[$name]['orders']++;
                                                        $productStats[$name]['revenue'] += ($product['price'] ?? 0) * ($product['qty'] ?? 1);
                                                        $productStats[$name]['qty'] += $product['qty'] ?? 1;
                                                    }
                                                }
                                            }
                                            $topProducts = array_slice(array_keys($productStats), 0, 5);
                                        @endphp
                                        @foreach($topProducts as $productName)
                                            <tr style="border-bottom: 1px solid #f0fdf4;">
                                                <td style="padding: 0.75rem; font-weight: 500;">{{ $productName }}</td>
                                                <td style="padding: 0.75rem;">{{ $productStats[$productName]['orders'] }}</td>
                                                <td style="padding: 0.75rem; color: #059669; font-weight: 600;">RM{{ number_format($productStats[$productName]['revenue'], 2) }}</td>
                                                <td style="padding: 0.75rem;">RM{{ number_format($productStats[$productName]['revenue'] / $productStats[$productName]['qty'], 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Products Section -->
                    <div id="products-content" style="display: none;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                            <h1>Manage Printing Services</h1>
                            <a href="{{ route('vendor3.products.create') }}" style="background: #16a34a; color: white; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-plus"></i>
                                Add New Service
                            </a>
                        </div>

                        <iframe src="{{ route('vendor3.products') }}" style="width: 100%; height: 600px; border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(22,163,74,0.08);"></iframe>
                    </div>

                    <!-- Complaints Section -->
                    <div id="complaints-content" style="display: none;">
                        <h1>Customer Complaints</h1>

                        @if($complaints->count() > 0)
                            <table class="orders-table" id="complaints-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer</th>
                                        <th>Subject</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($complaints as $complaint)
                                    <tr>
                                        <td>{{ $complaint->id }}</td>
                                        <td>
                                            <div>{{ $complaint->user_name }}</div>
                                            <div style="font-size: 0.85rem; color: #059669;">{{ $complaint->user_email }}</div>
                                        </td>
                                        <td>
                                            <div style="font-weight: 600;">{{ $complaint->subject }}</div>
                                            <div style="font-size: 0.9rem; color: #059669; margin-top: 0.25rem;">
                                                {{ Str::limit($complaint->description, 80) }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="status {{ $complaint->priority }}">
                                                {{ ucfirst($complaint->priority) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="status {{ $complaint->status == 'pending' ? 'awaiting' : ($complaint->status == 'resolved' ? 'confirmed' : 'ready') }}">
                                                {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                                            </span>
                                        </td>
                                        <td class="date">{{ $complaint->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('vendor.complaints.updateStatus', $complaint->id) }}" class="status-form" style="flex-direction: column; align-items: stretch; gap: 0.5rem;">
                                                @csrf
                                                <select name="status" required>
                                                    <option value="pending" {{ $complaint->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="in_progress" {{ $complaint->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                    <option value="resolved" {{ $complaint->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                                    <option value="closed" {{ $complaint->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                                </select>
                                                <textarea name="admin_response" placeholder="Add your response (optional)" rows="2" style="padding: 0.35rem 0.7rem; border-radius: 7px; border: 1px solid #e5e7eb; font-size: 0.97rem; background: #f0fdf4; color: #064e3b; resize: vertical;">{{ $complaint->admin_response }}</textarea>
                                                <button type="submit" style="align-self: flex-start;">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="no-orders">
                                <i class="fas fa-exclamation-triangle"></i>
                                <p>No complaints yet.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Settings Section -->
                    <div id="settings-content" style="display: none;">
                        <h1>Account Settings</h1>

                        <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 8px rgba(22,163,74,0.08); max-width: 600px;">
                            <h3 style="color: #15803d; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                                <i class="fas fa-key"></i> Change Password
                            </h3>

                            <div id="password-step-1">
                                <p style="margin-bottom: 1rem; color: #059669;">Enter your email to receive an OTP for password verification.</p>
                                <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                                    <input type="email" id="vendor-email" placeholder="Enter your email"
                                           value="setepakprintingservicektf@gmail.com" readonly
                                           style="flex: 1; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 8px; background: #f0fdf4;">
                                    <button onclick="sendOTP()" id="send-otp-btn"
                                            style="background: #16a34a; color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 500;">
                                        Send OTP
                                    </button>
                                </div>
                            </div>

                            <div id="password-step-2" style="display: none;">
                                <p style="margin-bottom: 1rem; color: #059669;">Enter the OTP sent to your email and your new password.</p>
                                <div style="display: flex; flex-direction: column; gap: 1rem;">
                                    <input type="text" id="otp-code" placeholder="Enter 6-digit OTP" maxlength="6"
                                           style="padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 8px;">
                                    <input type="password" id="new-password" placeholder="New password (min 8 characters)"
                                           style="padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 8px;">
                                    <input type="password" id="confirm-password" placeholder="Confirm new password"
                                           style="padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 8px;">
                                    <div style="display: flex; gap: 1rem;">
                                        <button onclick="changePassword()" id="change-password-btn"
                                                style="flex: 1; background: #059669; color: white; border: none; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-weight: 500;">
                                            Change Password
                                        </button>
                                        <button onclick="resetPasswordForm()"
                                                style="background: #6b7280; color: white; border: none; padding: 0.75rem 1rem; border-radius: 8px; cursor: pointer;">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div id="password-message" style="margin-top: 1rem; padding: 0.75rem; border-radius: 8px; display: none;"></div>
                        </div>
                    </div>

                    @if(session('success'))
                        <div style="margin-top:1.5rem; color:#059669; background:#ecfdf5; border:1px solid #a7f3d0; border-radius:8px; padding:1rem; text-align:center;">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="footer">
                &copy; {{ date('Y') }} UTM Commerce Connect - Setepak Printing Service KTF. All rights reserved.
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function toggleSection(section) {
            const ordersContent = document.getElementById('orders-content');
            const analyticsContent = document.getElementById('analytics-content');
            const productsContent = document.getElementById('products-content');
            const complaintsContent = document.getElementById('complaints-content');
            const filterForm = document.querySelector('.filter-form');

            // Hide all sections
            ordersContent.style.display = 'none';
            analyticsContent.style.display = 'none';
            productsContent.style.display = 'none';
            complaintsContent.style.display = 'none';
            const settingsContent = document.getElementById('settings-content');
            if (settingsContent) settingsContent.style.display = 'none';

            // Remove active class from all nav links
            document.querySelectorAll('.sidebar-nav a').forEach(a => a.classList.remove('active'));

            if (section === 'analytics') {
                analyticsContent.style.display = 'block';
                filterForm.style.display = 'none';
                document.querySelector('a[onclick*="analytics"]').classList.add('active');
                setTimeout(() => initializeCharts(), 100);
            } else if (section === 'products') {
                productsContent.style.display = 'block';
                filterForm.style.display = 'none';
                document.querySelector('a[onclick*="products"]').classList.add('active');
            } else if (section === 'complaints') {
                complaintsContent.style.display = 'block';
                filterForm.style.display = 'none';
                document.querySelector('a[onclick*="complaints"]').classList.add('active');
            } else if (section === 'settings') {
                const settingsContent = document.getElementById('settings-content');
                if (settingsContent) {
                    settingsContent.style.display = 'block';
                    console.log('Showing settings section');
                }
                filterForm.style.display = 'none';
                const settingsLink = document.querySelector('a[onclick*="settings"]');
                if (settingsLink) settingsLink.classList.add('active');
            } else {
                ordersContent.style.display = 'block';
                filterForm.style.display = 'flex';
                document.querySelector('a[href*="setepak"]').classList.add('active');
            }
        }

        function updateAnalytics() {
            const period = document.getElementById('period').value;
            console.log('Updating printing analytics for period:', period);

            // Show loading state
            const updateBtn = document.querySelector('button[onclick="updateAnalytics()"]');
            const originalText = updateBtn.innerHTML;
            updateBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
            updateBtn.disabled = true;

            // Use dedicated analytics endpoint
            const url = `{{ route('vendor.dashboard.setepak.analytics') }}?period=${period}`;

            fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                credentials: 'same-origin'
            })
                .then(response => {
                    console.log('Response status:', response.status);
                    console.log('Response content-type:', response.headers.get('content-type'));

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    return response.json();
                })
                .then(data => {
                    console.log('Received analytics data:', data);

                    if (data && data.success !== false) {
                        // Update metrics with animation
                        const cards = document.querySelectorAll('.analytics-grid .analytics-card');

                        if (cards[0]) {
                            const revenueEl = cards[0].querySelector('.metric-value');
                            revenueEl.style.opacity = '0.5';
                            setTimeout(() => {
                                revenueEl.textContent = `RM${data.total_revenue}`;
                                revenueEl.style.opacity = '1';
                            }, 200);
                        }

                        if (cards[1]) {
                            const ordersEl = cards[1].querySelector('.metric-value');
                            ordersEl.style.opacity = '0.5';
                            setTimeout(() => {
                                ordersEl.textContent = data.total_orders;
                                ordersEl.style.opacity = '1';
                            }, 300);
                        }

                        if (cards[2]) {
                            const avgEl = cards[2].querySelector('.metric-value');
                            avgEl.style.opacity = '0.5';
                            setTimeout(() => {
                                avgEl.textContent = `RM${data.avg_order_value}`;
                                avgEl.style.opacity = '1';
                            }, 400);
                        }

                        if (cards[3]) {
                            const rateEl = cards[3].querySelector('.metric-value');
                            rateEl.style.opacity = '0.5';
                            setTimeout(() => {
                                rateEl.textContent = `${data.completion_rate}%`;
                                rateEl.style.opacity = '1';
                            }, 500);
                        }

                        // Update chart with real data
                        if (data.daily_sales && Array.isArray(data.daily_sales)) {
                            initializeCharts(data.daily_sales);
                        }

                        console.log('Analytics updated successfully');
                    } else {
                        throw new Error(data.error || 'Invalid response data');
                    }
                })
                .catch(error => {
                    console.error('Error updating analytics:', error);
                    // Show error message to user
                    alert('Failed to update analytics. Please try again.');
                    // Fallback to static data
                    initializeCharts();
                })
                .finally(() => {
                    // Reset button state
                    updateBtn.innerHTML = originalText;
                    updateBtn.disabled = false;
                });
        }

        function initializeCharts(dailySalesData = null) {
            const ctx = document.getElementById('salesChart');
            if (!ctx) return;

            // Use real data if available, otherwise fallback to static data
            const salesData = dailySalesData || [60, 95, 140, 180, 125, 200, 175];
            const labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

            // Clear existing chart if it exists
            if (window.salesChart instanceof Chart) {
                window.salesChart.destroy();
            }

            window.salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Daily Printing Revenue (RM)',
                        data: salesData,
                        borderColor: '#16a34a',
                        backgroundColor: 'rgba(22, 163, 74, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f0fdf4'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }

        // Password change functions
        function sendOTP() {
            const email = document.getElementById('vendor-email').value;
            const btn = document.getElementById('send-otp-btn');
            const originalText = btn.textContent;

            btn.textContent = 'Sending...';
            btn.disabled = true;

            fetch('{{ route('vendor.password.sendOtp') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email: email })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('password-step-1').style.display = 'none';
                    document.getElementById('password-step-2').style.display = 'block';
                    showPasswordMessage(data.message, 'success');
                } else {
                    showPasswordMessage(data.message, 'error');
                }
            })
            .catch(error => {
                showPasswordMessage('Failed to send OTP', 'error');
            })
            .finally(() => {
                btn.textContent = originalText;
                btn.disabled = false;
            });
        }

        function changePassword() {
            const email = document.getElementById('vendor-email').value;
            const otp = document.getElementById('otp-code').value;
            const newPassword = document.getElementById('new-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;

            if (!otp || otp.length !== 6) {
                showPasswordMessage('Please enter a valid 6-digit OTP', 'error');
                return;
            }

            if (newPassword !== confirmPassword) {
                showPasswordMessage('Passwords do not match', 'error');
                return;
            }

            if (newPassword.length < 8) {
                showPasswordMessage('Password must be at least 8 characters long', 'error');
                return;
            }

            const btn = document.getElementById('change-password-btn');
            const originalText = btn.textContent;

            btn.textContent = 'Changing...';
            btn.disabled = true;

            fetch('{{ route('vendor.password.change') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    email: email,
                    otp: otp,
                    new_password: newPassword,
                    new_password_confirmation: confirmPassword
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showPasswordMessage(data.message, 'success');
                    setTimeout(() => resetPasswordForm(), 2000);
                } else {
                    showPasswordMessage(data.message, 'error');
                }
            })
            .catch(error => {
                showPasswordMessage('Failed to change password', 'error');
            })
            .finally(() => {
                btn.textContent = originalText;
                btn.disabled = false;
            });
        }

        function resetPasswordForm() {
            document.getElementById('password-step-1').style.display = 'block';
            document.getElementById('password-step-2').style.display = 'none';
            document.getElementById('otp-code').value = '';
            document.getElementById('new-password').value = '';
            document.getElementById('confirm-password').value = '';
            document.getElementById('password-message').style.display = 'none';
        }

        function showPasswordMessage(message, type) {
            const messageDiv = document.getElementById('password-message');
            messageDiv.textContent = message;
            messageDiv.style.display = 'block';
            messageDiv.style.background = type === 'success' ? '#ecfdf5' : '#fef2f2';
            messageDiv.style.color = type === 'success' ? '#065f46' : '#991b1b';
            messageDiv.style.border = type === 'success' ? '1px solid #a7f3d0' : '1px solid #fecaca';
        }
    </script>
</body>
</html>
