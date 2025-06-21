<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($product) ? 'Edit' : 'Add' }} Menu Item - Richiamo Caffe</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: #F5F5DC;
            margin: 0;
            padding: 2rem;
            color: #2F1B14;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #8B4513;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #8B4513;
            box-shadow: 0 0 0 3px rgba(139, 69, 19, 0.1);
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }

        .btn-primary {
            background: #8B4513;
            color: white;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .error {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>{{ isset($product) ? 'Edit' : 'Add New' }} Menu Item</h2>

        <form method="POST" action="{{ isset($product) ? route('vendor2.products.update', $product->id) : route('vendor2.products.store') }}">
            @csrf
            @if(isset($product))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="name">Menu Item Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name ?? '') }}" required>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Price (RM) *</label>
                <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price', $product->price ?? '') }}" required>
                @error('price')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="qty">Stock Quantity *</label>
                <input type="number" id="qty" name="qty" min="0" value="{{ old('qty', $product->qty ?? '') }}" required>
                @error('qty')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="short_description">Short Description *</label>
                <textarea id="short_description" name="short_description" rows="3" required>{{ old('short_description', $product->short_description ?? '') }}</textarea>
                @error('short_description')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="long_description">Long Description</label>
                <textarea id="long_description" name="long_description" rows="5">{{ old('long_description', $product->long_description ?? '') }}</textarea>
                @error('long_description')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status *</label>
                <select id="status" name="status" required>
                    <option value="1" {{ old('status', $product->status ?? '') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $product->status ?? '') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    {{ isset($product) ? 'Update' : 'Create' }} Menu Item
                </button>
                <a href="javascript:history.back()" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <script>
        // Show success message if redirected from successful operation
        @if(session('success'))
            // Create floating success message
            const successMessage = document.createElement('div');
            successMessage.innerHTML = `
                <div style="position: fixed; top: 20px; right: 20px; background: #dcfce7; color: #166534; padding: 1rem 2rem; border-radius: 8px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1); z-index: 1000; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            `;
            document.body.appendChild(successMessage);

            // Auto hide after 3 seconds
            setTimeout(() => {
                successMessage.remove();
                // Redirect back to products page after showing message
                window.parent.location.reload();
            }, 3000);
        @endif
    </script>
</body>
</html>
