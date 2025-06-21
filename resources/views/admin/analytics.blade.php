<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics & Reports - Admin Dashboard</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Same base styles as other admin pages */
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --secondary: #3b82f6;
            --success: #059669;
            --warning: #f59e0b;
            --danger: #dc2626;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-700: #374151;
            --gray-900: #111827;
            --white: #ffffff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: var(--gray-50); color: var(--gray-900); line-height: 1.6; }
        .admin-layout { display: flex; min-height: 100vh; }
        .sidebar { width: 280px; background: var(--white); box-shadow: 2px 0 10px rgba(0,0,0,0.1); position: fixed; height: 100vh; overflow-y: auto; z-index: 1000; }
        .sidebar-header { padding: 2rem 1.5rem; border-bottom: 1px solid var(--gray-200); text-align: center; }
        .sidebar-header h2 { color: var(--primary); font-size: 1.5rem; font-weight: 600; }
        .sidebar-nav { padding: 1rem 0; }
        .nav-item { margin: 0.25rem 1rem; }
        .nav-link { display: flex; align-items: center; gap: 0.75rem; padding: 0.875rem 1rem; color: var(--gray-700); text-decoration: none; border-radius: 8px; transition: all 0.2s; font-weight: 500; }
        .nav-link:hover, .nav-link.active { background: var(--primary); color: var(--white); }
        .nav-link i { width: 20px; text-align: center; }
        .main-content { margin-left: 280px; flex: 1; padding: 2rem; }
        .header { background: var(--white); padding: 1.5rem 2rem; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { color: var(--gray-900); font-size: 2rem; font-weight: 600; }
        .logout-btn { background: var(--danger); color: var(--white); border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 500; transition: all 0.2s; }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--white);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border-left: 4px solid var(--primary);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stat-title {
            color: var(--gray-700);
            font-size: 0.875rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: var(--white);
            background: var(--primary);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--gray-900);
        }

        .chart-container {
            background: var(--white);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }

        .vendor-analytics {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .vendor-card {
            background: var(--white);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .vendor-card h4 {
            color: var(--gray-900);
            margin-bottom: 1rem;
            font-size: 1.25rem;
        }

        .vendor-stat {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            color: var(--gray-700);
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-shield-alt"></i> Admin Panel</h2>
            </div>
            <nav class="sidebar-nav">
                <div class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.users') }}" class="nav-link">
                        <i class="fas fa-users"></i>
                        User Management
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.vendors') }}" class="nav-link">
                        <i class="fas fa-store"></i>
                        Vendor Management
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.products') }}" class="nav-link">
                        <i class="fas fa-box"></i>
                        Product Management
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.complaints') }}" class="nav-link">
                        <i class="fas fa-comment-alt"></i>
                        Complaints
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.analytics') }}" class="nav-link active">
                        <i class="fas fa-chart-line"></i>
                        Analytics & Reports
                    </a>
                </div>
            </nav>
        </aside>

        <main class="main-content">
            <div class="header">
                <h1>Analytics & Reports</h1>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Total Users</div>
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ number_format($totalUsers) }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Total Orders</div>
                        <div class="stat-icon" style="background: var(--success);">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ number_format($totalOrders) }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Total Products</div>
                        <div class="stat-icon" style="background: var(--warning);">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ number_format($totalProducts) }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Total Revenue</div>
                        <div class="stat-icon" style="background: var(--success);">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                    <div class="stat-value">RM{{ number_format($totalRevenue, 2) }}</div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                <div class="chart-container">
                    <h3 style="color: var(--gray-900); margin-bottom: 1.5rem;">Monthly Order Trends</h3>
                    <canvas id="ordersChart" width="400" height="200"></canvas>
                </div>

                <div class="chart-container">
                    <h3 style="color: var(--gray-900); margin-bottom: 1.5rem;">Vendor Distribution</h3>
                    <canvas id="vendorChart" width="400" height="200"></canvas>
                </div>
            </div>

            <div class="vendor-analytics">
                @foreach($vendorAnalytics as $vendor)
                <div class="vendor-card">
                    <h4>{{ $vendor['name'] }}</h4>
                    <div class="vendor-stat">
                        <span>Orders:</span>
                        <span style="font-weight: 600;">{{ $vendor['orders'] }}</span>
                    </div>
                    <div class="vendor-stat">
                        <span>Revenue:</span>
                        <span style="font-weight: 600; color: var(--success);">RM{{ number_format($vendor['revenue'], 2) }}</span>
                    </div>
                    <div class="vendor-stat">
                        <span>Products:</span>
                        <span style="font-weight: 600;">{{ $vendor['products'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="chart-container">
                <h3 style="color: var(--gray-900); margin-bottom: 1.5rem;">Top Products</h3>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="border-bottom: 2px solid var(--gray-200);">
                                <th style="text-align: left; padding: 0.75rem; color: var(--gray-700);">Product Name</th>
                                <th style="text-align: left; padding: 0.75rem; color: var(--gray-700);">Vendor</th>
                                <th style="text-align: left; padding: 0.75rem; color: var(--gray-700);">Price</th>
                                <th style="text-align: left; padding: 0.75rem; color: var(--gray-700);">Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topProducts as $product)
                                <tr style="border-bottom: 1px solid var(--gray-200);">
                                    <td style="padding: 0.75rem; font-weight: 500;">{{ $product->name }}</td>
                                    <td style="padding: 0.75rem;">
                                        @if($product->vendor_id == 1)
                                            UTM Mart
                                        @elseif($product->vendor_id == 2)
                                            Setepak Printing
                                        @elseif($product->vendor_id == 3)
                                            Richiamo Caffe
                                        @else
                                            Vendor {{ $product->vendor_id }}
                                        @endif
                                    </td>
                                    <td style="padding: 0.75rem; color: var(--success); font-weight: 600;">RM{{ number_format($product->price, 2) }}</td>
                                    <td style="padding: 0.75rem;">{{ $product->qty }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Monthly Orders Chart
        const ordersCtx = document.getElementById('ordersChart').getContext('2d');
        const ordersData = @json($monthlyOrders);

        new Chart(ordersCtx, {
            type: 'line',
            data: {
                labels: ordersData.map(item => item.month),
                datasets: [{
                    label: 'Orders',
                    data: ordersData.map(item => item.orders),
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Vendor Distribution Chart
        const vendorCtx = document.getElementById('vendorChart').getContext('2d');
        const vendorData = @json($vendorAnalytics);

        new Chart(vendorCtx, {
            type: 'doughnut',
            data: {
                labels: vendorData.map(item => item.name),
                datasets: [{
                    data: vendorData.map(item => item.orders),
                    backgroundColor: ['#2563eb', '#059669', '#f59e0b'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</body>
</html>
