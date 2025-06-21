<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Menu Items - Richiamo Caffe</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: #F5F5DC;
            margin: 0;
            padding: 1rem;
            color: #2F1B14;
        }

        .products-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 2px 8px rgba(139,69,19,0.08);
        }

        th, td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background: #F5F5DC;
            color: #654321;
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        tr:hover {
            background: #fefbf5;
        }

        .status-active {
            background: #dcfce7;
            color: #166534;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-inactive {
            background: #fee2e2;
            color: #991b1b;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-edit {
            background: #8B4513;
            color: white;
        }

        .btn-delete {
            background: #dc2626;
            color: white;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .search-form {
            margin-bottom: 1rem;
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .search-input {
            padding: 0.5rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    @if(session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
            {{ session('success') }}
        </div>
    @endif

    <table class="products-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>
                        <div style="font-weight: 600;">{{ $product->name }}</div>
                        <div style="font-size: 0.875rem; color: #6b7280;">{{ Str::limit($product->short_description, 60) }}</div>
                    </td>
                    <td>RM{{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->qty }}</td>
                    <td>
                        <span class="{{ $product->status ? 'status-active' : 'status-inactive' }}">
                            {{ $product->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('vendor2.products.edit', $product->id) }}" class="btn btn-edit" target="_parent">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('vendor2.products.delete', $product->id) }}" style="display: inline;" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 2rem; color: #6b7280;">
                        No menu items found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
