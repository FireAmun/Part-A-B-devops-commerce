<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management - Admin Dashboard</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
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
        .logout-btn:hover { background: #b91c1c; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 1rem 1.5rem; text-align: left; border-bottom: 1px solid var(--gray-200); }
        .table th { background: var(--gray-50); font-weight: 600; color: var(--gray-700); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .table td { color: var(--gray-900); }

        .product-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            margin-right: 1rem;
        }

        .product-info {
            display: flex;
            align-items: center;
        }

        .product-icon {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.5rem;
        }

        .utm-icon { background: #dbeafe; color: var(--primary); }
        .setepak-icon { background: #dcfce7; color: #16a34a; }
        .caffe-icon { background: #fef3c7; color: #d97706; }

        .btn-group {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-warning {
            background: var(--warning);
            color: var(--white);
        }

        .btn-warning:hover {
            background: #d97706;
        }

        .btn-danger {
            background: var(--danger);
            color: var(--white);
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        /* Pagination Styles */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            padding: 1.5rem 2rem;
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .pagination .page-item {
            margin: 0;
        }

        .pagination .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0.5rem 0.75rem;
            margin: 0;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--gray-700);
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .pagination .page-link:hover {
            background: var(--gray-50);
            border-color: var(--primary);
            color: var(--primary);
        }

        .pagination .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--white);
        }

        .pagination .page-item.disabled .page-link {
            color: var(--gray-300);
            background: var(--gray-50);
            border-color: var(--gray-200);
            cursor: not-allowed;
        }

        .pagination .page-link svg {
            width: 16px;
            height: 16px;
        }

        /* Custom pagination info */
        .pagination-info {
            font-size: 0.875rem;
            color: var(--gray-700);
            margin-right: 1rem;
        }

        /* Override Laravel's default pagination styles */
        .pagination .page-link[rel="prev"]::before {
            content: '‹';
            font-size: 1.2rem;
            font-weight: bold;
        }

        .pagination .page-link[rel="next"]::before {
            content: '›';
            font-size: 1.2rem;
            font-weight: bold;
        }

        .pagination .page-link[rel="prev"] svg,
        .pagination .page-link[rel="next"] svg {
            display: none;
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
                    <a href="{{ route('admin.products') }}" class="nav-link active">
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
                    <a href="{{ route('admin.analytics') }}" class="nav-link">
                        <i class="fas fa-chart-line"></i>
                        Analytics & Reports
                    </a>
                </div>
            </nav>
        </aside>

        <main class="main-content">
            <div class="header">
                <h1>Product Management</h1>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>

            @if(session('success'))
                <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; border: 1px solid #bbf7d0;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="background: var(--white); border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); overflow: hidden;">
                <div style="background: var(--gray-50); padding: 1.5rem 2rem; border-bottom: 1px solid var(--gray-200);">
                    <h3 style="font-size: 1.25rem; font-weight: 600; color: var(--gray-900);">All Products</h3>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Vendor</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>
                                <div class="product-info">
                                    @php
                                        $productName = strtolower($product->name);
                                        $hasImage = false;
                                        $imagePath = '';
                                        $iconClass = '';
                                        $iconBgClass = '';

                                        // Determine if product has image or needs icon
                                        if ($product->vendor_id == 1) {
                                            // UTM Mart - has images
                                            if (str_contains($productName, 'shirt')) {
                                                $imagePath = asset('images/utm-shirt.jpeg');
                                                $hasImage = true;
                                            } elseif (str_contains($productName, 'cup')) {
                                                $imagePath = asset('images/utm-cup.jpeg');
                                                $hasImage = true;
                                            } elseif (str_contains($productName, 'book')) {
                                                $imagePath = asset('images/utm-books.jpeg');
                                                $hasImage = true;
                                            } else {
                                                $iconClass = 'fas fa-shopping-bag';
                                                $iconBgClass = 'utm-icon';
                                            }
                                        } elseif ($product->vendor_id == 2) {
                                            // Setepak Printing - use icons
                                            if (str_contains($productName, 'business card')) {
                                                $iconClass = 'fas fa-id-card';
                                            } elseif (str_contains($productName, 'banner')) {
                                                $iconClass = 'fas fa-flag';
                                            } elseif (str_contains($productName, 'sticker')) {
                                                $iconClass = 'fas fa-tags';
                                            } elseif (str_contains($productName, 'flyer')) {
                                                $iconClass = 'fas fa-file-pdf';
                                            } elseif (str_contains($productName, 'brochure')) {
                                                $iconClass = 'fas fa-book-open';
                                            } elseif (str_contains($productName, 'photocopy')) {
                                                $iconClass = 'fas fa-copy';
                                            } elseif (str_contains($productName, 't-shirt')) {
                                                $iconClass = 'fas fa-tshirt';
                                            } else {
                                                $iconClass = 'fas fa-print';
                                            }
                                            $iconBgClass = 'setepak-icon';
                                        } elseif ($product->vendor_id == 3) {
                                            // Richiamo Caffe - has images
                                            $imageName = str_replace(' ', '-', $productName) . '.png';
                                            $imagePath = asset('images/caffe/' . $imageName);
                                            $hasImage = true;
                                        } else {
                                            $iconClass = 'fas fa-box';
                                            $iconBgClass = 'utm-icon';
                                        }
                                    @endphp

                                    @if($hasImage)
                                        <img src="{{ $imagePath }}" alt="{{ $product->name }}" class="product-image"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="product-icon {{ $iconBgClass }}" style="display: none;">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @else
                                        <div class="product-icon {{ $iconBgClass }}">
                                            <i class="{{ $iconClass }}"></i>
                                        </div>
                                    @endif

                                    <div>
                                        <div style="font-weight: 600;">{{ $product->name }}</div>
                                        <div style="font-size: 0.875rem; color: var(--gray-700);">ID: {{ $product->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($product->vendor_id == 1)
                                    <span style="background: #dbeafe; color: var(--primary); padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 500;">
                                        <i class="fas fa-store"></i> UTM Mart
                                    </span>
                                @elseif($product->vendor_id == 2)
                                    <span style="background: #dcfce7; color: #16a34a; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 500;">
                                        <i class="fas fa-print"></i> Setepak Printing
                                    </span>
                                @elseif($product->vendor_id == 3)
                                    <span style="background: #fef3c7; color: #d97706; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 500;">
                                        <i class="fas fa-mug-hot"></i> Richiamo Caffe
                                    </span>
                                @else
                                    <span style="background: var(--gray-200); color: var(--gray-700); padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 500;">
                                        Vendor {{ $product->vendor_id }}
                                    </span>
                                @endif
                            </td>
                            <td style="font-weight: 600; color: var(--success);">RM{{ number_format($product->price, 2) }}</td>
                            <td>
                                <span style="background: var(--gray-100); color: var(--gray-900); padding: 0.25rem 0.75rem; border-radius: 6px; font-weight: 500;">
                                    {{ $product->qty }} units
                                </span>
                            </td>
                            <td>
                                @if($product->status)
                                    <span style="background: #dcfce7; color: #166534; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 500;">
                                        <i class="fas fa-check-circle"></i> Active
                                    </span>
                                @else
                                    <span style="background: #fef2f2; color: #991b1b; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; font-weight: 500;">
                                        <i class="fas fa-times-circle"></i> Inactive
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button onclick="deleteProduct({{ $product->id }}, '{{ $product->name }}')" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 2rem; color: var(--gray-700);">
                                <i class="fas fa-box-open" style="font-size: 2rem; margin-bottom: 1rem; color: var(--gray-300);"></i>
                                <div>No products found</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="pagination-wrapper">
                    @if($products->hasPages())
                        <div class="pagination-info">
                            Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} results
                        </div>

                        <nav aria-label="Pagination Navigation">
                            <ul class="pagination">
                                {{-- Previous Page Link --}}
                                @if ($products->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">‹</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev">‹</a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                    @if ($page == $products->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($products->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next">›</a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">›</span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    @else
                        <div class="pagination-info">
                            Showing all {{ $products->count() }} results
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 2000;">
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 2rem; border-radius: 12px; width: 90%; max-width: 400px;">
            <h3 style="margin-bottom: 1rem; color: var(--danger);">
                <i class="fas fa-exclamation-triangle"></i> Confirm Deletion
            </h3>
            <p style="margin-bottom: 1.5rem; color: var(--gray-700);">
                Are you sure you want to delete product <strong id="productName"></strong>? This action cannot be undone.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                <button onclick="closeDeleteModal()" style="background: var(--gray-200); color: var(--gray-700); border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer;">
                    Cancel
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background: var(--danger); color: var(--white); border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer;">
                        <i class="fas fa-trash"></i> Delete Product
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function deleteProduct(productId, productName) {
            document.getElementById('productName').textContent = productName;
            document.getElementById('deleteForm').action = `/admin/products/${productId}`;
            document.getElementById('deleteModal').style.display = 'block';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>
</body>
</html>
