<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTM Mart - UTM Commerce Connect</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #1e3a8a;
            --primary-light: #2563eb;
            --secondary: #3b82f6;
            --accent: #f59e0b;
            --text: #1f2937;
            --text-light: #6b7280;
            --white: #ffffff;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, var(--gray-100), var(--white));
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: var(--text);
        }

        .navbar {
            background-color: var(--white);
            padding: 1rem 2rem;
            color: var(--text);
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: var(--transition);
        }

        .navbar.scrolled {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .navbar h1 {
            margin: 0;
            font-size: 1.5rem;
            color: var(--primary);
            font-weight: 700;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .nav-icons {
            display: flex;
            gap: 1rem;
        }

        .nav-icon {
            position: relative;
            color: var(--text);
            font-size: 1.25rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .nav-icon:hover {
            color: var(--primary);
        }

        .nav-icon .badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--accent);
            color: var(--white);
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 10px;
            font-weight: 600;
        }

        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid var(--primary);
            transition: var(--transition);
        }

        .profile-icon:hover {
            transform: scale(1.05);
        }

        .profile-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-dropdown {
            position: absolute;
            top: 70px;
            right: 20px;
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 0.5rem;
            display: none;
            z-index: 1000;
            min-width: 200px;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .profile-dropdown a,
        .profile-dropdown button {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--text);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            border-radius: 8px;
            width: 100%;
            border: none;
            background: none;
            cursor: pointer;
            font-size: 0.95rem;
        }

        .profile-dropdown a:hover,
        .profile-dropdown button:hover {
            background: var(--gray-100);
            color: var(--primary);
        }

        .profile-dropdown i {
            width: 20px;
            color: var(--text-light);
        }

        .profile-container {
            position: relative;
        }

        .profile-container.active .profile-dropdown {
            display: block;
        }

        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1604719312566-8912e9227c6a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') no-repeat center center/cover;
            color: var(--white);
            text-align: center;
            padding: 8rem 2rem 4rem;
            position: relative;
            margin-bottom: 2rem;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            opacity: 0.9;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .welcome {
            text-align: center;
            margin-bottom: 3rem;
        }

        .welcome h2 {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .welcome p {
            color: var(--text-light);
            font-size: 1.1rem;
        }

        .filter-section {
            background: var(--white);
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }

        .search-bar {
            position: relative;
            margin-bottom: 1rem;
        }

        .search-bar input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            font-size: 1rem;
            transition: var(--transition);
            background: var(--gray-100);
        }

        .search-bar input:focus {
            outline: none;
            border-color: var(--primary);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .search-bar i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .filter-controls {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .category-select {
            flex: 1;
            padding: 1rem;
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            font-size: 1rem;
            background: var(--gray-100);
            color: var(--text);
            transition: var(--transition);
        }

        .category-select:focus {
            outline: none;
            border-color: var(--primary);
            background: var(--white);
        }

        .filter-btn {
            padding: 1rem 2rem;
            background: var(--primary);
            color: var(--white);
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-btn:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
        }

        .section-title {
            font-size: 1.75rem;
            color: var(--primary);
            margin: 2rem 0;
            text-align: center;
            font-weight: 700;
        }

        .category-section {
            margin-bottom: 3rem;
        }

        .category-title {
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
            font-weight: 600;
            border-bottom: 2px solid var(--accent);
            padding-bottom: 0.5rem;
        }

        .products-container {
            position: relative;
            overflow: hidden;
        }

        .products-scroll {
            display: flex;
            gap: 1.5rem;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding: 1rem 0;
        }

        .products-scroll::-webkit-scrollbar {
            height: 8px;
        }

        .products-scroll::-webkit-scrollbar-track {
            background: var(--gray-100);
            border-radius: 4px;
        }

        .products-scroll::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 4px;
        }

        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: var(--primary);
            color: var(--white);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2rem;
            box-shadow: var(--shadow);
            transition: var(--transition);
            z-index: 10;
        }

        .scroll-btn:hover {
            background: var(--primary-light);
            transform: translateY(-50%) scale(1.1);
        }

        .scroll-left {
            left: -15px;
        }

        .scroll-right {
            right: -15px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .product-card {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            position: relative;
            min-width: 280px;
            flex-shrink: 0;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            height: 180px;
            overflow: hidden;
            position: relative;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: var(--transition);
            padding: 10px;
        }

        .product-card:hover .product-image img {
            transform: scale(1.1);
        }

        .product-content {
            padding: 1.5rem;
        }

        .product-content h4 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            color: var(--text);
        }

        .product-price {
            font-size: 1.5rem;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .product-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            flex: 1;
            padding: 0.75rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: var(--primary);
            color: var(--white);
            border: none;
        }

        .btn-primary:hover {
            background: var(--primary-light);
        }

        .btn-secondary {
            background: var(--gray-100);
            color: var(--text);
            border: none;
        }

        .btn-secondary:hover {
            background: var(--gray-200);
        }

        footer {
            background: var(--primary);
            color: var(--white);
            padding: 4rem 0 2rem;
            margin-top: auto;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
        }

        .footer-column h3 {
            color: var(--white);
            margin-bottom: 1.5rem;
            font-size: 1.25rem;
        }

        .footer-column p {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            color: var(--white);
            font-size: 1.25rem;
            transition: var(--transition);
        }

        .social-links a:hover {
            color: var(--accent);
            transform: translateY(-3px);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.75rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-links a:hover {
            color: var(--white);
            transform: translateX(5px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            margin-top: 3rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }

        .dark-mode-toggle {
            display: flex;
            align-items: center;
            cursor: pointer;
            position: relative;
            width: 50px;
            height: 25px;
            background: var(--gray-200);
            border-radius: 25px;
            transition: var(--transition);
        }

        .dark-mode-toggle.active {
            background: var(--primary);
        }

        .dark-mode-toggle .toggle-circle {
            position: absolute;
            top: 2px;
            left: 2px;
            width: 21px;
            height: 21px;
            background: var(--white);
            border-radius: 50%;
            transition: var(--transition);
        }

        .dark-mode-toggle.active .toggle-circle {
            transform: translateX(25px);
        }

        .dark-mode-toggle .icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.8rem;
            color: var(--text);
        }

        .dark-mode-toggle .icon.sun {
            left: 5px;
        }

        .dark-mode-toggle .icon.moon {
            right: 5px;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
            }

            .hero {
                padding: 6rem 1rem 3rem;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .container {
                padding: 1rem;
            }

            .filter-controls {
                flex-direction: column;
            }

            .product-grid {
                grid-template-columns: 1fr;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }

        /* Dark mode styles */
        body.dark-mode {
            background: linear-gradient(135deg, #1a1a1a, #2d2d2d);
            color: #e5e5e5;
        }

        .dark-mode .navbar {
            background: rgba(26, 26, 26, 0.95);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .dark-mode .navbar h1 {
            color: #e5e5e5;
        }

        .dark-mode .nav-icon {
            color: #e5e5e5;
        }

        .dark-mode .profile-dropdown {
            background: #2d2d2d;
        }

        .dark-mode .profile-dropdown a,
        .dark-mode .profile-dropdown button {
            color: #e5e5e5;
        }

        .dark-mode .profile-dropdown a:hover,
        .dark-mode .profile-dropdown button:hover {
            background: #404040;
        }

        .dark-mode .filter-section {
            background: #2d2d2d;
        }

        .dark-mode .search-bar input,
        .dark-mode .category-select {
            background: #404040;
            border-color: #4b5563;
            color: #e5e5e5;
        }

        .dark-mode .product-card {
            background: #2d2d2d;
        }

        .dark-mode .product-content h4 {
            color: #e5e5e5;
        }

        .dark-mode .btn-secondary {
            background: #404040;
            color: #e5e5e5;
        }

        .dark-mode .btn-secondary:hover {
            background: #4b5563;
        }

        .dark-mode footer {
            background: #1a1a1a;
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--primary);
            color: var(--white);
            padding: 1rem 2rem;
            border-radius: 8px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        .toast i {
            font-size: 1.2rem;
        }

        .toast.success {
            background: #059669;
        }

        .toast.error {
            background: #dc2626;
        }

        .featured-container {
            margin: 0 auto;
            text-align: center;
            max-width: 1200px;
        }

        .featured-products {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
            margin: 0 auto;
            max-width: 1200px;
        }

        .featured-card {
            flex: 0 0 calc(33.333% - 2rem);
            max-width: 350px;
            margin-bottom: 2rem;
        }

        @media (max-width: 1100px) {
            .featured-card {
                flex: 0 0 calc(50% - 2rem);
            }
        }

        @media (max-width: 768px) {
            .featured-card {
                flex: 0 0 100%;
            }
        }

        /* Dark mode styles */
    </style>
</head>
<body class="fade-in">
    <nav class="navbar">
        <h1>UTM Mart</h1>
        <div class="navbar-right">
            <div class="nav-icons">
                <a href="{{ route('wishlist.view') }}" class="nav-icon" id="wishlist-icon">
                    <i class="fas fa-heart"></i>
                    <span class="badge" id="wishlist-count">0</span>
                </a>
                <a href="{{ route('cart.view') }}" class="nav-icon" id="cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="badge" id="cart-count">0</span>
                </a>
            </div>
            <div class="dark-mode-toggle" id="dark-mode-toggle">
                <span class="icon sun">☀️</span>
                <span class="icon moon">🌙</span>
                <div class="toggle-circle"></div>
            </div>
            <div class="profile-container" id="profile-container">
                <div class="profile-icon" onclick="toggleDropdown()">
                    <img src="https://img.icons8.com/fluency/96/user-male-circle.png" alt="Profile">
                </div>
                <div class="profile-dropdown">
                    <a href="{{ route('profile.edit') }}">
                        <i class="fas fa-user"></i>
                        Profile
                    </a>
                    <a href="{{ route('orders.index') }}">
                        <i class="fas fa-shopping-bag"></i>
                        Orders
                    </a>
                    <a href="{{ route('wishlist.view') }}">
                        <i class="fas fa-heart"></i>
                        Wishlist
                    </a>
                    <a href="{{ route('complaints.index') }}">
                        <i class="fas fa-exclamation-triangle"></i>
                        Complaints
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">
                            <i class="fas fa-sign-out-alt"></i>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero">
        <h1>Welcome to UTM Mart</h1>
        <p>Your go-to shop for daily essentials on campus.</p>
    </section>

    <div class="container">
        <a href="{{ route('home') }}" style="display:inline-block; margin-bottom:1.5rem; background:#e5e7eb; color:#1e3a8a; border:none; border-radius:6px; padding:0.5rem 1.2rem; cursor:pointer; font-weight:500; text-decoration:none;">
            <i class="fas fa-arrow-left"></i> Back to Vendors
        </a>
        <div class="welcome">
            <h2>Hello!</h2>
            <p>Check out our latest offers and stock up your essentials.</p>
        </div>

        <div class="filter-section">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" id="search-bar" placeholder="Search for a product..." oninput="filterProducts()">
            </div>
            <div class="filter-controls">
                <select id="category-dropdown" class="category-select">
                    <option value="All">All Categories</option>
                    <option value="1">Apparel</option>
                    <option value="2">Drinkware</option>
                    <option value="3">Stationery</option>
                    <option value="4">Bags</option>
                    <option value="5">Awards & Recognition</option>
                    <option value="6">Accessories</option>
                </select>
                <button onclick="applyCategoryFilter()" class="filter-btn">
                    <i class="fas fa-filter"></i>
                    Apply Filter
                </button>
            </div>
        </div>

        <!-- Featured Products -->
        <h2 class="section-title">Featured Products</h2>
        <div class="featured-container">
            <div class="featured-products">
                <div class="product-card featured-card" data-category="Shirts">
                    <div class="product-image">
                        <img src="{{ asset('images/utmmart/utm-shirt.jpeg') }}" alt="UTM Shirt">
                    </div>
                    <div class="product-content">
                        <h4>UTM Shirt</h4>
                        <div class="product-price">RM25.00</div>
                        <p>Classic UTM branded t-shirt, perfect for everyday wear.</p>
                        <div class="product-actions">
                            <button class="btn btn-primary" onclick="addToCart(1)">
                                <i class="fas fa-shopping-cart"></i>
                                Add to Cart
                            </button>
                            <button class="btn btn-secondary" onclick="addToWishlist(1)">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="product-card featured-card" data-category="Accessories">
                    <div class="product-image">
                        <img src="{{ asset('images/utmmart/utm-cup.jpeg') }}" alt="UTM Cup">
                    </div>
                    <div class="product-content">
                        <h4>UTM Cup</h4>
                        <div class="product-price">RM15.00</div>
                        <p>High-quality UTM branded coffee cup.</p>
                        <div class="product-actions">
                            <button class="btn btn-primary" onclick="addToCart(2)">
                                <i class="fas fa-shopping-cart"></i>
                                Add to Cart
                            </button>
                            <button class="btn btn-secondary" onclick="addToWishlist(2)">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="product-card featured-card" data-category="Accessories">
                    <div class="product-image">
                        <img src="{{ asset('images/utmmart/utm-books.jpeg') }}" alt="UTM Books">
                    </div>
                    <div class="product-content">
                        <h4>UTM Books</h4>
                        <div class="product-price">RM40.00</div>
                        <p>Collection of UTM branded notebooks and journals.</p>
                        <div class="product-actions">
                            <button class="btn btn-primary" onclick="addToCart(3)">
                                <i class="fas fa-shopping-cart"></i>
                                Add to Cart
                            </button>
                            <button class="btn btn-secondary" onclick="addToWishlist(3)">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-top: 3rem;"></div> <!-- Extra spacing -->

        <!-- Apparel Section -->
        <div class="category-section" data-category="1">
            <h3 class="category-title">
                <i class="fas fa-tshirt"></i> Apparel
            </h3>
            <div class="products-container">
                <button class="scroll-btn scroll-left" onclick="scrollProducts('apparel', 'left')">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="products-scroll" id="apparel">
                    @foreach($productsByCategory[1] ?? [] as $product)
                    @if(!in_array($product->id, [1, 2, 3])) <!-- Skip featured products -->
                    <div class="product-card" data-category="1">
                        <div class="product-image">
                            <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="product-content">
                            <h4>{{ $product->name }}</h4>
                            <div class="product-price">RM{{ number_format($product->price, 2) }}</div>
                            <p>{{ $product->short_description }}</p>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart({{ $product->id }})">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist({{ $product->id }})">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <button class="scroll-btn scroll-right" onclick="scrollProducts('apparel', 'right')">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- Drinkware Section -->
        <div class="category-section" data-category="2">
            <h3 class="category-title">
                <i class="fas fa-glass-whiskey"></i> Drinkware
            </h3>
            <div class="products-container">
                <button class="scroll-btn scroll-left" onclick="scrollProducts('drinkware', 'left')">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="products-scroll" id="drinkware">
                    @foreach($productsByCategory[2] ?? [] as $product)
                    @if(!in_array($product->id, [1, 2, 3])) <!-- Skip featured products -->
                    <div class="product-card" data-category="2">
                        <div class="product-image">
                            <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="product-content">
                            <h4>{{ $product->name }}</h4>
                            <div class="product-price">RM{{ number_format($product->price, 2) }}</div>
                            <p>{{ $product->short_description }}</p>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart({{ $product->id }})">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist({{ $product->id }})">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <button class="scroll-btn scroll-right" onclick="scrollProducts('drinkware', 'right')">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- Stationery Section -->
        <div class="category-section" data-category="3">
            <h3 class="category-title">
                <i class="fas fa-pen"></i> Stationery
            </h3>
            <div class="products-container">
                <button class="scroll-btn scroll-left" onclick="scrollProducts('stationery', 'left')">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="products-scroll" id="stationery">
                    @foreach($productsByCategory[3] ?? [] as $product)
                    @if(!in_array($product->id, [1, 2, 3])) <!-- Skip featured products -->
                    <div class="product-card" data-category="3">
                        <div class="product-image">
                            <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="product-content">
                            <h4>{{ $product->name }}</h4>
                            <div class="product-price">RM{{ number_format($product->price, 2) }}</div>
                            <p>{{ $product->short_description }}</p>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart({{ $product->id }})">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist({{ $product->id }})">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <button class="scroll-btn scroll-right" onclick="scrollProducts('stationery', 'right')">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- Bags Section -->
        <div class="category-section" data-category="4">
            <h3 class="category-title">
                <i class="fas fa-shopping-bag"></i> Bags
            </h3>
            <div class="products-container">
                <button class="scroll-btn scroll-left" onclick="scrollProducts('bags', 'left')">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="products-scroll" id="bags">
                    @foreach($productsByCategory[4] ?? [] as $product)
                    @if(!in_array($product->id, [1, 2, 3])) <!-- Skip featured products -->
                    <div class="product-card" data-category="4">
                        <div class="product-image">
                            <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="product-content">
                            <h4>{{ $product->name }}</h4>
                            <div class="product-price">RM{{ number_format($product->price, 2) }}</div>
                            <p>{{ $product->short_description }}</p>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart({{ $product->id }})">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist({{ $product->id }})">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <button class="scroll-btn scroll-right" onclick="scrollProducts('bags', 'right')">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- Awards & Recognition Section -->
        <div class="category-section" data-category="5">
            <h3 class="category-title">
                <i class="fas fa-award"></i> Awards & Recognition
            </h3>
            <div class="products-container">
                <button class="scroll-btn scroll-left" onclick="scrollProducts('awards', 'left')">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="products-scroll" id="awards">
                    @foreach($productsByCategory[5] ?? [] as $product)
                    @if(!in_array($product->id, [1, 2, 3])) <!-- Skip featured products -->
                    <div class="product-card" data-category="5">
                        <div class="product-image">
                            <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="product-content">
                            <h4>{{ $product->name }}</h4>
                            <div class="product-price">RM{{ number_format($product->price, 2) }}</div>
                            <p>{{ $product->short_description }}</p>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart({{ $product->id }})">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist({{ $product->id }})">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <button class="scroll-btn scroll-right" onclick="scrollProducts('awards', 'right')">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- Accessories Section -->
        <div class="category-section" data-category="6">
            <h3 class="category-title">
                <i class="fas fa-suitcase"></i> Accessories
            </h3>
            <div class="products-container">
                <button class="scroll-btn scroll-left" onclick="scrollProducts('accessories', 'left')">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="products-scroll" id="accessories">
                    @foreach($productsByCategory[6] ?? [] as $product)
                    @if(!in_array($product->id, [1, 2, 3])) <!-- Skip featured products -->
                    <div class="product-card" data-category="6">
                        <div class="product-image">
                            <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="product-content">
                            <h4>{{ $product->name }}</h4>
                            <div class="product-price">RM{{ number_format($product->price, 2) }}</div>
                            <p>{{ $product->short_description }}</p>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart({{ $product->id }})">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist({{ $product->id }})">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <button class="scroll-btn scroll-right" onclick="scrollProducts('accessories', 'right')">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h3>About UTM Mart</h3>
                <p>We offer a wide variety of daily goods at affordable prices. Visit us in UTM JB!</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="{{ url('/about-us') }}"><i class="fas fa-chevron-right"></i> About Us</a></li>
                    <li><a href="{{ url('/contact') }}"><i class="fas fa-chevron-right"></i> Contact</a></li>
                    <li><a href="{{ url('/terms-con') }}"><i class="fas fa-chevron-right"></i> Terms & Conditions</a></li>
                    <li><a href="{{ url('/privacy-pol') }}"><i class="fas fa-chevron-right"></i> Privacy Policy</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Working Hours</h3>
                <ul class="footer-links">
                    <li><i class="fas fa-clock"></i> Mon-Thu: 8:30 A.M. – 1 P.M., 2 P.M. – 4.45 P.M.</li>
                    <li><i class="fas fa-clock"></i> Fri: 8:30 A.M. – 12.15 P.M., 2.30 P.M. – 4.45 P.M.</li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Contact Us</h3>
                <ul class="footer-links">
                    <li><a href="tel:+60149321546"><i class="fas fa-phone"></i> +60149321546</a></li>
                    <li><a href="mailto:utmart@utm.my"><i class="fas fa-envelope"></i> utmart@utm.my</a></li>
                    <li><a href="https://www.facebook.com/UTMMart" target="_blank"><i class="fab fa-facebook"></i> UTM Mart</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 UTM Mart - UTM Commerce Connect. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Initialize cart and wishlist when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Update cart and wishlist counts
            updateCartCount();
            updateWishlistCount();
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Profile dropdown
        function toggleDropdown() {
            const container = document.getElementById('profile-container');
            container.classList.toggle('active');
        }

        // Dark mode functionality is now handled by dark-mode.js

        // Close dropdown if clicked outside
        document.addEventListener('click', function(event) {
            const container = document.getElementById('profile-container');
            if (!container.contains(event.target)) {
                container.classList.remove('active');
            }
        });

        // Product filtering
        function filterProducts() {
            const searchQuery = document.getElementById('search-bar').value.toLowerCase();

            // Hide/show products based on search
            const products = document.querySelectorAll('.product-card');
            let anyVisible = false;

            products.forEach(product => {
                const productName = product.querySelector('h4').textContent.toLowerCase();
                const isVisible = productName.includes(searchQuery);
                product.style.display = isVisible ? 'block' : 'none';
                if (isVisible) anyVisible = true;
            });

            // If search is empty, show all category sections
            if (searchQuery === '') {
                document.querySelectorAll('.category-section').forEach(section => {
                    section.style.display = 'block';
                });
            } else {
                // Hide empty category sections when searching
                document.querySelectorAll('.category-section').forEach(section => {
                    const visibleProducts = section.querySelectorAll('.product-card[style="display: block;"]');
                    section.style.display = visibleProducts.length > 0 ? 'block' : 'none';
                });
            }
        }

        // Product scrolling
        function scrollProducts(containerId, direction) {
            const container = document.getElementById(containerId);
            const scrollAmount = 300;

            if (direction === 'left') {
                container.scrollLeft -= scrollAmount;
            } else {
                container.scrollLeft += scrollAmount;
            }
        }

        function applyCategoryFilter() {
            const selectedCategory = document.getElementById('category-dropdown').value;
            const sections = document.querySelectorAll('.category-section');

            sections.forEach(section => {
                const sectionCategory = section.getAttribute('data-category');
                section.style.display = (selectedCategory === 'All' || sectionCategory === selectedCategory) ? 'block' : 'none';
            });
        }

        // Toast notification function
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                ${message}
            `;
            document.body.appendChild(toast);

            // Show toast
            setTimeout(() => toast.classList.add('show'), 100);

            // Hide and remove toast
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Update cart count on page load
        function updateCartCount() {
            fetch('/cart/count')
                .then(res => res.json())
                .then(data => {
                    document.getElementById('cart-count').textContent = data.count;
                })
                .catch(error => {
                    console.error('Error updating cart count:', error);
                });
        }
        updateCartCount();

        // Update wishlist count on page load
        function updateWishlistCount() {
            fetch('/wishlist/count')
                .then(res => res.json())
                .then(data => {
                    document.getElementById('wishlist-count').textContent = data.count;
                })
                .catch(error => {
                    console.error('Error updating wishlist count:', error);
                });
        }
        updateWishlistCount();

        function addToCart(productId) {
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId,
                    vendor_type: 'utm'
                })
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById('cart-count').textContent = data.count;
                showToast('Product added to cart successfully!');
            })
            .catch(error => {
                console.error('Error adding to cart:', error);
                showToast('Failed to add product to cart', 'error');
            });
        }

        function addToWishlist(productId) {
            fetch('/wishlist/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId,
                    vendor_type: 'utm'
                })
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById('wishlist-count').textContent = data.count;
                showToast('Product added to wishlist!');
            })
            .catch(error => {
                console.error('Error adding to wishlist:', error);
                showToast('Failed to add product to wishlist', 'error');
            });
        }
    </script>
    <!-- Dark mode script -->
    <script src="{{ asset('js/dark-mode.js') }}"></script>
</body>
</html>
