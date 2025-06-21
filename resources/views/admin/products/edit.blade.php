<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Admin Dashboard</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.clou                <div class="nav-item">
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
                    <a href="{{ route('admin.analytics') }}" class="nav-link">
                        <i class="fas fa-chart-line"></i>
                        Analytics & Reports
                    </a>
                </div>jax/libs/font-awesome/6.0.0/css/all.min.css">
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: var(--gray-50);
            color: var(--gray-900);
            line-height: 1.6;
        }

        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: var(--white);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            text-align: center;
        }

        .sidebar-header h2 {
            color: var(--primary);
            font-size: 1.5rem;
            font-weight: 600;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-item {
            margin: 0.25rem 1rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            color: var(--gray-700);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s;
            font-weight: 500;
        }

        .nav-link:hover,
        .nav-link.active {
            background: var(--primary);
            color: var(--white);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
        }

        .main-content {
            margin-left: 280px;
            flex: 1;
            padding: 2rem;
        }

        .header {
            background: var(--white);
            padding: 1.5rem 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            color: var(--gray-900);
            font-size: 2rem;
            font-weight: 600;
        }

        .logout-btn {
            background: var(--danger);
            color: var(--white);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
        }

        .logout-btn:hover {
            background: #b91c1c;
        }

        .form-container {
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            padding: 2rem;
            max-width: 800px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--gray-700);
            font-size: 0.875rem;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid var(--gray-200);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s ease;
            background: var(--white);
            color: var(--gray-900);
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.875rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            font-family: inherit;
            font-size: 1rem;
        }

        .btn-primary {
            background: var(--primary);
            color: var(--white);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-secondary {
            background: var(--gray-200);
            color: var(--gray-700);
        }

        .btn-secondary:hover {
            background: var(--gray-300);
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
            transition: all 0.2s;
            text-decoration: none;
            font-family: inherit;
        }

        .back-btn:hover {
            background: var(--gray-200);
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .product-info-card {
            background: var(--gray-50);
            padding: 1.5rem;
            border-radius: 8px;
            margin: 1rem 0;
            border: 1px solid var(--gray-200);
        }

        .product-info-card h4 {
            color: var(--gray-700);
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .product-info-card p {
            color: var(--gray-600);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .product-info-card strong {
            color: var(--gray-700);
        }

        /* Fix for select dropdown */
        select option {
            background: var(--white);
            color: var(--gray-900);
        }

        /* Fix for number inputs */
        input[type="number"] {
            -webkit-appearance: none;
            -moz-appearance: textfield;
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
            .form-container {
                padding: 1.5rem;
            }
            .btn-group {
                flex-direction: column;
            }
            .form-row {
                grid-template-columns: 1fr;
            }
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
                    <a href="{{ route('admin.analytics') }}" class="nav-link">
                        <i class="fas fa-chart-line"></i>
                        Analytics & Reports
                    </a>
                </div>
            </nav>
        </aside>

        <main class="main-content">
            <div class="header">
                <h1>Edit Product</h1>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>

            <div class="form-container">
                <a href="{{ route('admin.products') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    Back to Products
                </a>

                @if ($errors->any())
                    <div class="alert alert-error">
                        <strong>Please fix the following errors:</strong>
                        <ul style="margin: 0.5rem 0 0 1.5rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.products.update', $product) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">
                            <i class="fas fa-box"></i> Product Name
                        </label>
                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name', $product->name) }}"
                               required
                               placeholder="Enter product name">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="price">
                                <i class="fas fa-dollar-sign"></i> Price (RM)
                            </label>
                            <input type="number"
                                   id="price"
                                   name="price"
                                   value="{{ old('price', $product->price) }}"
                                   step="0.01"
                                   min="0"
                                   required
                                   placeholder="0.00">
                        </div>

                        <div class="form-group">
                            <label for="qty">
                                <i class="fas fa-warehouse"></i> Quantity
                            </label>
                            <input type="number"
                                   id="qty"
                                   name="qty"
                                   value="{{ old('qty', $product->qty) }}"
                                   min="0"
                                   required
                                   placeholder="0">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="short_description">
                            <i class="fas fa-align-left"></i> Short Description
                        </label>
                        <textarea id="short_description"
                                  name="short_description"
                                  required
                                  placeholder="Enter a brief description of the product">{{ old('short_description', $product->short_description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="long_description">
                            <i class="fas fa-align-justify"></i> Long Description (Optional)
                        </label>
                        <textarea id="long_description"
                                  name="long_description"
                                  rows="4"
                                  placeholder="Enter detailed description of the product">{{ old('long_description', $product->long_description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="status">
                            <i class="fas fa-toggle-on"></i> Status
                        </label>
                        <select id="status" name="status" required>
                            <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="product-info-card">
                        <h4><i class="fas fa-info-circle"></i> Product Information</h4>
                        <p><strong>Vendor:</strong>
                            @if($product->vendor_id == 1)
                                UTM Mart
                            @elseif($product->vendor_id == 2)
                                Setepak Printing Service KTF
                            @elseif($product->vendor_id == 3)
                                Richiamo Caffe
                            @else
                                Vendor ID: {{ $product->vendor_id }}
                            @endif
                        </p>
                        <p><strong>Product ID:</strong> {{ $product->id }}</p>
                        <p><strong>Created:</strong> {{ $product->created_at->format('M d, Y H:i') }}</p>
                    </div>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Update Product
                        </button>
                        <a href="{{ route('admin.products') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i>
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
