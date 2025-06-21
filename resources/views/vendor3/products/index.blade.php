<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products - Setepak Printing Service</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: #f0fdf4;
            margin: 0;
            padding: 2rem;
            color: #064e3b;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(22, 163, 74, 0.1);
            padding: 2rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f0fdf4;
        }

        .header h1 {
            color: #16a34a;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .add-btn {
            background: #16a34a;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }

        .add-btn:hover {
            background: #15803d;
            transform: translateY(-2px);
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .product-card {
            background: white;
            border: 2px solid #f0fdf4;
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.3s;
        }

        .product-card:hover {
            border-color: #16a34a;
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(22, 163, 74, 0.15);
        }

        .service-icon {
            width: 80px;
            height: 80px;
            background: #f0fdf4;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .service-icon i {
            font-size: 2rem;
            color: #16a34a;
        }

        .product-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: #064e3b;
            margin-bottom: 0.5rem;
        }

        .product-price {
            font-size: 1.4rem;
            font-weight: 700;
            color: #059669;
            margin-bottom: 1rem;
        }

        .product-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            transition: all 0.2s;
        }

        .btn-edit {
            background: #fbbf24;
            color: white;
        }

        .btn-edit:hover {
            background: #f59e0b;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
        }

        .btn-delete:hover {
            background: #dc2626;
        }

        .no-products {
            text-align: center;
            padding: 4rem 2rem;
            color: #059669;
        }

        .no-products i {
            font-size: 4rem;
            color: #22c55e;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>
                <i class="fas fa-print"></i>
                Printing Services Management
            </h1>
            <a href="{{ route('vendor3.products.create') }}" class="add-btn">
                <i class="fas fa-plus"></i>
                Add New Service
            </a>
        </div>

        @if(isset($products) && count($products) > 0)
            <div class="products-grid">
                @foreach($products as $product)
                    <div class="product-card">
                        <div class="service-icon">
                            @php
                                $productName = strtolower($product->name);
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
                                } elseif (str_contains($productName, 'packaging')) {
                                    $iconClass = 'fas fa-box';
                                } else {
                                    $iconClass = 'fas fa-print';
                                }
                            @endphp
                            <i class="{{ $iconClass }}"></i>
                        </div>
                        <div class="product-name">{{ $product->name }}</div>
                        <div class="product-price">RM{{ number_format($product->price, 2) }}</div>
                        <div class="product-actions">
                            <a href="{{ route('vendor3.products.edit', $product->id) }}" class="btn btn-edit">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('vendor3.products.delete', $product->id) }}"
                                  style="display: inline;"
                                  onsubmit="return confirm('Are you sure you want to delete this service?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-products">
                <i class="fas fa-print"></i>
                <h3>No printing services yet</h3>
                <p>Add your first printing service to get started.</p>
            </div>
        @endif
    </div>

    <script>
        function deleteProduct(id) {
            if (confirm('Are you sure you want to delete this service?')) {
                // Handle deletion
                console.log('Delete product:', id);
            }
        }
    </script>
</body>
</html>
