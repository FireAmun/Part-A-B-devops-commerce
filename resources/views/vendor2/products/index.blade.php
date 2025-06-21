<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products - Richiamo Caffe</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: #F5F5DC;
            margin: 0;
            padding: 2rem;
            color: #2F1B14;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(139, 69, 19, 0.1);
            padding: 2rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #F5F5DC;
        }

        .header h1 {
            color: #8B4513;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .add-btn {
            background: #8B4513;
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
            background: #654321;
            transform: translateY(-2px);
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .product-card {
            background: white;
            border: 2px solid #F5F5DC;
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.3s;
        }

        .product-card:hover {
            border-color: #8B4513;
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(139, 69, 19, 0.15);
        }

        .product-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2F1B14;
            margin-bottom: 0.5rem;
        }

        .product-price {
            font-size: 1.4rem;
            font-weight: 700;
            color: #8B4513;
            margin-bottom: 1rem;
        }

        .product-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
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
            font-size: 0.9rem;
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

        .product-description {
            color: #6b4a2d;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .no-products {
            text-align: center;
            padding: 4rem 2rem;
            color: #6b4a2d;
        }

        .no-products i {
            font-size: 4rem;
            color: #A0522D;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>
                <i class="fas fa-mug-hot"></i>
                Coffee Menu Management
            </h1>
            <a href="{{ route('vendor2.products.create') }}" class="add-btn">
                <i class="fas fa-plus"></i>
                Add New Item
            </a>
        </div>

        @if(isset($products) && count($products) > 0)
            <div class="products-grid">
                @foreach($products as $product)
                    <div class="product-card">
                        <div class="product-name">{{ $product->name }}</div>
                        <div class="product-description">{{ $product->short_description }}</div>
                        <div class="product-price">RM{{ number_format($product->price, 2) }}</div>
                        <div class="product-actions">
                            <a href="{{ route('vendor2.products.edit', $product->id) }}" class="btn btn-edit">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('vendor2.products.delete', $product->id) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this product?')">
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
                <i class="fas fa-mug-hot"></i>
                <h3>No coffee items yet</h3>
                <p>Add your first coffee item to get started.</p>
            </div>
        @endif
    </div>
</body>
</html>
