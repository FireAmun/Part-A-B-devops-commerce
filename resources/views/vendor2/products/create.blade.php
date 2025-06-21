<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Menu Item - Richiamo Caffe</title>
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
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(139, 69, 19, 0.1);
            padding: 2rem;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #F5F5DC;
        }

        .header h1 {
            color: #8B4513;
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
            color: #2F1B14;
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
            border-color: #8B4513;
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
            background: #8B4513;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background: #654321;
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
                <i class="fas fa-plus-circle"></i>
                Add New Menu Item
            </h1>
        </div>

        <form method="POST" action="{{ route('vendor2.products.store') }}">
            @csrf

            <div class="form-group">
                <label for="name">Item Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="price">Price (RM)</label>
                <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price') }}" required>
            </div>

            <div class="form-group">
                <label for="qty">Quantity Available</label>
                <input type="number" id="qty" name="qty" min="0" value="{{ old('qty', 1) }}" required>
            </div>

            <div class="form-group">
                <label for="short_description">Short Description</label>
                <input type="text" id="short_description" name="short_description" value="{{ old('short_description') }}" required>
            </div>

            <div class="form-group">
                <label for="long_description">Long Description</label>
                <textarea id="long_description" name="long_description" rows="3">{{ old('long_description') }}</textarea>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Add Item
                </button>
                <a href="{{ route('vendor2.products') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Cancel
                </a>
            </div>
        </form>
    </div>
</body>
</html>
