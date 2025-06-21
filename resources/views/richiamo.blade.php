<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Richiamo Coffee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .hero-section {
            background: linear-gradient(135deg, #8B4513, #D2691E);
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .hero-section p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }
        .btn-custom {
            background-color: #fff;
            color: #8B4513;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #8B4513;
            color: white;
            text-decoration: none;
        }
        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 50px;
        }
        .category-section {
            margin-bottom: 60px;
        }
        .category-title {
            background: linear-gradient(135deg, #8B4513, #D2691E);
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            border-radius: 10px 10px 0 0;
            margin-bottom: 0;
        }
        .products-table {
            background: white;
            border-radius: 0 0 10px 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .table {
            margin-bottom: 0;
        }
        .table thead th {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 15px;
            font-weight: bold;
        }
        .table tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
        }
        .table tbody tr:last-child td {
            border-bottom: none;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa;
        }
        .price {
            color: #8B4513;
            font-weight: bold;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .nav-link.active {
            background-color: #8B4513 !important;
            border-radius: 5px;
        }
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 30px 0;
            margin-top: 50px;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        .btn-action {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.8rem;
            transition: all 0.3s ease;
        }
        .btn-cart {
            background-color: #28a745;
            color: white;
        }
        .btn-cart:hover {
            background-color: #218838;
            color: white;
        }
        .btn-wishlist {
            background-color: #dc3545;
            color: white;
        }
        .btn-wishlist:hover {
            background-color: #c82333;
            color: white;
        }
        .cart-badge {
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 0.7rem;
            position: absolute;
            top: -5px;
            right: -5px;
        }
        .nav-icon {
            position: relative;
            margin-right: 15px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Commerce App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav me-auto">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                    <a class="nav-link active" href="{{ route('richiamo') }}">Richiamo Coffee</a>
                </div>
                <div class="navbar-nav ms-auto">
                    <a class="nav-link nav-icon" href="#" id="cartIcon">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-badge" id="cartCount">0</span>
                    </a>
                    <a class="nav-link nav-icon" href="#" id="wishlistIcon">
                        <i class="fas fa-heart"></i>
                        <span class="cart-badge" id="wishlistCount">0</span>
                    </a>
                    <a class="nav-link" href="#">
                        <i class="fas fa-user"></i> Account
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1>Welcome to Richiamo Coffee</h1>
            <p>Premium Coffee & Delicious Food Experience</p>
            <a href="#products" class="btn-custom">View Our Menu</a>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-5" id="products">
        <div class="container">
            <h2 class="section-title">Our Menu</h2>

            @if($productsByCategory && $productsByCategory->count() > 0)
                @foreach($productsByCategory as $category => $products)
                    <div class="category-section">
                        <h3 class="category-title">{{ $category }}</h3>
                        <div class="products-table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 50%;">Item</th>
                                        <th style="width: 20%;">Price</th>
                                        <th style="width: 30%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td class="price">RM {{ number_format($product->price, 2) }}</td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn-action btn-cart" onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }})">
                                                        <i class="fas fa-cart-plus"></i> Add to Cart
                                                    </button>
                                                    <button class="btn-action btn-wishlist" onclick="addToWishlist({{ $product->id }}, '{{ $product->name }}', {{ $product->price }})">
                                                        <i class="fas fa-heart"></i> Wishlist
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center">
                    <div class="alert alert-info">
                        <h4>No Products Available</h4>
                        <p>We're currently updating our menu. Please check back later!</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h5>Richiamo Coffee</h5>
                    <p>Premium coffee and delicious food for everyone.</p>
                    <div class="social-links">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="col-md-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50">About Us</a></li>
                        <li><a href="#" class="text-white-50">Our Menu</a></li>
                        <li><a href="#" class="text-white-50">Locations</a></li>
                        <li><a href="#" class="text-white-50">Careers</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Customer Service</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50">Contact Us</a></li>
                        <li><a href="#" class="text-white-50">FAQ</a></li>
                        <li><a href="#" class="text-white-50">Privacy Policy</a></li>
                        <li><a href="#" class="text-white-50">Terms & Conditions</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Contact Info</h5>
                    <p class="text-white-50">
                        <i class="fas fa-envelope"></i> info@richiamocoffee.com<br>
                        <i class="fas fa-phone"></i> +60 12-345-6789<br>
                        <i class="fas fa-map-marker-alt"></i> UTM Campus, Johor Bahru
                    </p>
                </div>
            </div>
            <hr style="border-color: #6c757d;">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; 2024 Richiamo Coffee. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-end">
                    <p>Powered by Commerce App</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Cart and Wishlist functionality
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

        function updateCartCount() {
            document.getElementById('cartCount').textContent = cart.length;
        }

        function updateWishlistCount() {
            document.getElementById('wishlistCount').textContent = wishlist.length;
        }

        function addToCart(id, name, price) {
            const existingItem = cart.find(item => item.id === id);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({ id, name, price, quantity: 1 });
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();

            // Show success message
            showMessage(`${name} added to cart!`, 'success');
        }

        function addToWishlist(id, name, price) {
            const existingItem = wishlist.find(item => item.id === id);
            if (!existingItem) {
                wishlist.push({ id, name, price });
                localStorage.setItem('wishlist', JSON.stringify(wishlist));
                updateWishlistCount();
                showMessage(`${name} added to wishlist!`, 'success');
            } else {
                showMessage(`${name} is already in your wishlist!`, 'warning');
            }
        }

        function showMessage(message, type) {
            const alert = document.createElement('div');
            alert.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            alert.style.top = '20px';
            alert.style.right = '20px';
            alert.style.zIndex = '9999';
            alert.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.body.appendChild(alert);

            setTimeout(() => {
                alert.remove();
            }, 3000);
        }

        // Initialize counts on page load
        updateCartCount();
        updateWishlistCount();
    </script>
</body>
</html>
