<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - UTM Mart</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 2rem;
            color: #1e293b;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(30, 58, 138, 0.1);
            padding: 2rem;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f1f5f9;
        }

        .header h1 {
            color: #1e40af;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #1e293b;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #2563eb;
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background: #1e40af;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
            border: none;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>
                <i class="fas fa-edit"></i>
                Edit Product
            </h1>
        </div>

        <form method="POST" action="{{ route('vendor.products.update', $product->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" id="name" name="name" value="{{ $product->name }}" required>
            </div>

            <div class="form-group">
                <label for="price">Price (RM)</label>
                <input type="number" id="price" name="price" step="0.01" min="0" value="{{ $product->price }}" required>
            </div>

            <div class="form-group">
                <label for="qty">Quantity Available</label>
                <input type="number" id="qty" name="qty" min="0" value="{{ $product->qty }}" required>
            </div>

            <div class="form-group">
                <label for="short_description">Short Description</label>
                <input type="text" id="short_description" name="short_description" value="{{ $product->short_description }}" required>
            </div>

            <div class="form-group">
                <label for="long_description">Long Description</label>
                <textarea id="long_description" name="long_description" rows="3">{{ $product->long_description }}</textarea>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Update Product
                </button>
                <a href="{{ route('vendor.products') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Cancel
                </a>
            </div>
        </form>
    </div>
</body>
</html>
