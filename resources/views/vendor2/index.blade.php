<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Richiamo Caffe - UTM Commerce Connect</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #8B4513;
            --primary-light: #A0522D;
            --secondary: #D2691E;
            --accent: #DEB887;
            --text: #2F1B14;
            --text-light: #6b4a2d;
            --white: #ffffff;
            --cream: #F5F5DC;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --shadow: 0 10px 25px rgba(139, 69, 19, 0.15);
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
            background: linear-gradient(rgba(139, 69, 19, 0.7), rgba(139, 69, 19, 0.7)), url('https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') no-repeat center center/cover;
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
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(139, 69, 19, 0.2);
        }

        .product-image {
            height: 180px;
            overflow: hidden;
            position: relative;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .product-card:hover .product-image img {
            transform: scale(1.1);
        }

        .product-content {
            padding: 1.25rem;
        }

        .product-content h4 {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            color: var(--text);
            font-weight: 600;
        }

        .product-price {
            font-size: 1.3rem;
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
            padding: 0.6rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            font-size: 0.85rem;
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
            background: var(--cream);
            color: var(--primary);
            border: 1px solid var(--accent);
        }

        .btn-secondary:hover {
            background: var(--accent);
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

            .product-card {
                min-width: 250px;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .scroll-btn {
                display: none;
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
    </style>
</head>
<body class="fade-in">
    <nav class="navbar">
        <h1>Richiamo Caffe</h1>
        <div class="navbar-right">
            <div class="nav-icons">
                <a href="{{ route('vendor2.wishlist.view') }}" class="nav-icon" id="wishlist-icon">
                    <i class="fas fa-heart"></i>
                    <span class="badge" id="wishlist-count">0</span>
                </a>
                <a href="{{ route('vendor2.cart.view') }}" class="nav-icon" id="cart-icon">
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
        <h1>Welcome to Richiamo Caffe</h1>
        <p>Premium coffee experience in the heart of UTM campus.</p>
    </section>

    <div class="container">
        <a href="{{ route('home') }}" style="display:inline-block; margin-bottom:1.5rem; background:#e5e7eb; color:#8B4513; border:none; border-radius:6px; padding:0.5rem 1.2rem; cursor:pointer; font-weight:500; text-decoration:none;">
            <i class="fas fa-arrow-left"></i> Back to Vendors
        </a>
        <div class="welcome">
            <h2>Benvenuto!</h2>
            <p>Discover our authentic Italian coffee and delicious treats.</p>
        </div>

        <div class="filter-section">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" id="search-bar" placeholder="Search for a product..." oninput="filterProducts()">
            </div>
            <div class="filter-controls">
                <select id="category-dropdown" class="category-select">
                    <option value="All">All Categories</option>
                    <option value="Hot Beverages">Hot Beverages</option>
                    <option value="Cold Beverages">Cold Beverages</option>
                    <option value="Smoothies">Smoothies</option>
                    <option value="Food">Food</option>
                </select>
                <button onclick="applyCategoryFilter()" class="filter-btn">
                    <i class="fas fa-filter"></i>
                    Apply Filter
                </button>
            </div>
        </div>

        <!-- Hot Beverages Section -->
        <div class="category-section" data-category="Hot Beverages">
            <h3 class="category-title">
                <i class="fas fa-mug-hot"></i> Hot Beverages
            </h3>
            <div class="products-container">
                <button class="scroll-btn scroll-left" onclick="scrollProducts('hot-beverages', 'left')">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="products-scroll" id="hot-beverages">
                    <div class="product-card" data-category="Hot Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/espresso.png') }}" alt="Espresso">
                        </div>
                        <div class="product-content">
                            <h4>Espresso</h4>
                            <div class="product-price">RM7.90</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(4)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(4)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Hot Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/double-espresso.png') }}" alt="Double Espresso">
                        </div>
                        <div class="product-content">
                            <h4>Double Espresso</h4>
                            <div class="product-price">RM9.50</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(5)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(5)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Hot Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/hot-americano.png') }}" alt="Hot Americano">
                        </div>
                        <div class="product-content">
                            <h4>Hot Americano</h4>
                            <div class="product-price">RM9.40</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(6)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(6)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Hot Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/hot-cappuccino.png') }}" alt="Hot Cappuccino">
                        </div>
                        <div class="product-content">
                            <h4>Hot Cappuccino</h4>
                            <div class="product-price">RM10.70</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(7)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(7)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Hot Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/hot-caramello-cappuccino.png') }}" alt="Hot Caramello Cappuccino">
                        </div>
                        <div class="product-content">
                            <h4>Hot Caramello Cappuccino</h4>
                            <div class="product-price">RM12.20</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(8)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(8)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Hot Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/hot-hazelnut-cappuccino.png') }}" alt="Hot Hazelnut Cappuccino">
                        </div>
                        <div class="product-content">
                            <h4>Hot Hazelnut Cappuccino</h4>
                            <div class="product-price">RM12.20</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(9)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(9)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Hot Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/hot-caffe-latte.png') }}" alt="Hot Caffe Latte">
                        </div>
                        <div class="product-content">
                            <h4>Hot Caffe Latte</h4>
                            <div class="product-price">RM10.70</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(10)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(10)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Hot Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/hot-caramello-latte.png') }}" alt="Hot Caramello Latte">
                        </div>
                        <div class="product-content">
                            <h4>Hot Caramello Latte</h4>
                            <div class="product-price">RM12.20</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(11)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(11)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Hot Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/hot-hazelnut-latte.png') }}" alt="Hot Hazelnut Latte">
                        </div>
                        <div class="product-content">
                            <h4>Hot Hazelnut Latte</h4>
                            <div class="product-price">RM12.20</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(12)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(12)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Hot Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/hot-salted-caramello-latte.png') }}" alt="Hot Salted Caramello Latte">
                        </div>
                        <div class="product-content">
                            <h4>Hot Salted Caramello Latte</h4>
                            <div class="product-price">RM12.20</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(13)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(13)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Hot Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/hot-white-mochaccino.png') }}" alt="Hot White Mochaccino">
                        </div>
                        <div class="product-content">
                            <h4>Hot White Mochaccino</h4>
                            <div class="product-price">RM12.20</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(14)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(14)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Hot Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/hot-caffe-vanilla.png') }}" alt="Hot Caffe Vanilla">
                        </div>
                        <div class="product-content">
                            <h4>Hot Caffe Vanilla</h4>
                            <div class="product-price">RM12.20</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(15)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(15)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Hot Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/hot-chocolate.png') }}" alt="Hot Chocolate">
                        </div>
                        <div class="product-content">
                            <h4>Hot Chocolate</h4>
                            <div class="product-price">RM10.70</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(16)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(16)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Hot Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/hot-vanilla-chocolate.png') }}" alt="Hot Vanilla Chocolate">
                        </div>
                        <div class="product-content">
                            <h4>Hot Vanilla Chocolate</h4>
                            <div class="product-price">RM12.20</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(17)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(17)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Hot Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/hot-caramello-chocolate.png') }}" alt="Hot Caramello Chocolate">
                        </div>
                        <div class="product-content">
                            <h4>Hot Caramello Chocolate</h4>
                            <div class="product-price">RM12.20</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(18)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(18)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Hot Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/hot-hazelnut-chocolate.png') }}" alt="Hot Hazelnut Chocolate">
                        </div>
                        <div class="product-content">
                            <h4>Hot Hazelnut Chocolate</h4>
                            <div class="product-price">RM12.20</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(19)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(19)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Hot Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/hot-matcha-latte.png') }}" alt="Hot Matcha Latte">
                        </div>
                        <div class="product-content">
                            <h4>Hot Matcha Latte</h4>
                            <div class="product-price">RM10.80</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(20)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(20)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Hot Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/hot-caffe-matcha-latte.png') }}" alt="Hot Caffe Matcha Latte">
                        </div>
                        <div class="product-content">
                            <h4>Hot Caffe Matcha Latte</h4>
                            <div class="product-price">RM11.50</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(21)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(21)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Hot Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/hot-teh-tarik-premium.png') }}" alt="Hot Teh Tarik Premium">
                        </div>
                        <div class="product-content">
                            <h4>Hot Teh Tarik Premium</h4>
                            <div class="product-price">RM9.40</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(22)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(22)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Hot Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/hot-fresh-lemon-tea.png') }}" alt="Hot Fresh Lemon Tea">
                        </div>
                        <div class="product-content">
                            <h4>Hot Fresh Lemon Tea</h4>
                            <div class="product-price">RM8.10</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(23)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(23)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Hot Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/hot-fresh-apple-tea.png') }}" alt="Hot Fresh Apple Tea">
                        </div>
                        <div class="product-content">
                            <h4>Hot Fresh Apple Tea</h4>
                            <div class="product-price">RM8.10</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(24)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(24)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Hot Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/hot-english-breakfast-tea.png') }}" alt="Hot English Breakfast Tea">
                        </div>
                        <div class="product-content">
                            <h4>Hot English Breakfast Tea</h4>
                            <div class="product-price">RM5.40</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(25)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(25)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Hot Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/hot-earl-grey-tea.png') }}" alt="Hot Earl Grey Tea">
                        </div>
                        <div class="product-content">
                            <h4>Hot Earl Grey Tea</h4>
                            <div class="product-price">RM5.40</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(26)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(26)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="scroll-btn scroll-right" onclick="scrollProducts('hot-beverages', 'right')">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- Cold Beverages Section -->
        <div class="category-section" data-category="Cold Beverages">
            <h3 class="category-title">
                <i class="fas fa-glass-whiskey"></i> Cold Beverages
            </h3>
            <div class="products-container">
                <button class="scroll-btn scroll-left" onclick="scrollProducts('cold-beverages', 'left')">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="products-scroll" id="cold-beverages">
                    <div class="product-card" data-category="Cold Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/iced-americano.png') }}" alt="Iced Americano">
                        </div>
                        <div class="product-content">
                            <h4>Iced Americano</h4>
                            <div class="product-price">RM12.10</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(27)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(27)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Cold Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/iced-white-mochaccino.png') }}" alt="Iced White Mochaccino">
                        </div>
                        <div class="product-content">
                            <h4>Iced White Mochaccino</h4>
                            <div class="product-price">RM13.40</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(28)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(28)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Cold Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/iced-cappuccino.png') }}" alt="Iced Cappuccino">
                        </div>
                        <div class="product-content">
                            <h4>Iced Cappuccino</h4>
                            <div class="product-price">RM12.10</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(29)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(29)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Cold Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/iced-caramello-cappuccino.png') }}" alt="Iced Caramello Cappuccino">
                        </div>
                        <div class="product-content">
                            <h4>Iced Caramello Cappuccino</h4>
                            <div class="product-price">RM13.40</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(30)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(30)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Cold Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/iced-hazelnut-cappuccino.png') }}" alt="Iced Hazelnut Cappuccino">
                        </div>
                        <div class="product-content">
                            <h4>Iced Hazelnut Cappuccino</h4>
                            <div class="product-price">RM13.40</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(31)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(31)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Cold Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/iced-caffe-latte.png') }}" alt="Iced Caffe Latte">
                        </div>
                        <div class="product-content">
                            <h4>Iced Caffe Latte</h4>
                            <div class="product-price">RM12.10</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(32)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(32)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Cold Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/iced-caramello-latte.png') }}" alt="Iced Caramello Latte">
                        </div>
                        <div class="product-content">
                            <h4>Iced Caramello Latte</h4>
                            <div class="product-price">RM13.40</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(33)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(33)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Cold Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/iced-hazelnut-latte.png') }}" alt="Iced Hazelnut Latte">
                        </div>
                        <div class="product-content">
                            <h4>Iced Hazelnut Latte</h4>
                            <div class="product-price">RM13.40</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(34)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(34)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Cold Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/iced-vanilla-latte.png') }}" alt="Iced Vanilla Latte">
                        </div>
                        <div class="product-content">
                            <h4>Iced Vanilla Latte</h4>
                            <div class="product-price">RM13.40</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(35)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(35)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Cold Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/iced-chocolate.png') }}" alt="Iced Chocolate">
                        </div>
                        <div class="product-content">
                            <h4>Iced Chocolate</h4>
                            <div class="product-price">RM12.10</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(36)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(36)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Cold Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/iced-classy-dark-chocolate.png') }}" alt="Iced Classy Dark Chocolate">
                        </div>
                        <div class="product-content">
                            <h4>Iced Classy Dark Chocolate</h4>
                            <div class="product-price">RM13.40</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(37)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(37)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Cold Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/iced-vanilla-chocolate.png') }}" alt="Iced Vanilla Chocolate">
                        </div>
                        <div class="product-content">
                            <h4>Iced Vanilla Chocolate</h4>
                            <div class="product-price">RM13.40</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(38)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(38)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Cold Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/iced-caramello-chocolate.png') }}" alt="Iced Caramello Chocolate">
                        </div>
                        <div class="product-content">
                            <h4>Iced Caramello Chocolate</h4>
                            <div class="product-price">RM13.40</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(39)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(39)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Cold Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/iced-hazelnut-chocolate.png') }}" alt="Iced Hazelnut Chocolate">
                        </div>
                        <div class="product-content">
                            <h4>Iced Hazelnut Chocolate</h4>
                            <div class="product-price">RM13.40</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(40)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(40)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Cold Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/iced-matcha-latte.png') }}" alt="Iced Matcha Latte">
                        </div>
                        <div class="product-content">
                            <h4>Iced Matcha Latte</h4>
                            <div class="product-price">RM13.40</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(41)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(41)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Cold Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/iced-caffe-matcha-latte.png') }}" alt="Iced Caffe Matcha Latte">
                        </div>
                        <div class="product-content">
                            <h4>Iced Caffe Matcha Latte</h4>
                            <div class="product-price">RM14.20</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(42)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(42)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Cold Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/iced-teh-tarik-premium.png') }}" alt="Iced Teh Tarik Premium">
                        </div>
                        <div class="product-content">
                            <h4>Iced Teh Tarik Premium</h4>
                            <div class="product-price">RM12.10</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(43)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(43)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Cold Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/iced-fresh-lemon-tea.png') }}" alt="Iced Fresh Lemon Tea">
                        </div>
                        <div class="product-content">
                            <h4>Iced Fresh Lemon Tea</h4>
                            <div class="product-price">RM10.70</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(44)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(44)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Cold Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/iced-fresh-apple-tea.png') }}" alt="Iced Fresh Apple Tea">
                        </div>
                        <div class="product-content">
                            <h4>Iced Fresh Apple Tea</h4>
                            <div class="product-price">RM10.70</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(45)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(45)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Cold Beverages">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/fresh-milk-brown-sugar-boba.png') }}" alt="Fresh Milk Brown Sugar Boba">
                        </div>
                        <div class="product-content">
                            <h4>Fresh Milk Brown Sugar Boba</h4>
                            <div class="product-price">RM13.40</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(46)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(46)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="scroll-btn scroll-right" onclick="scrollProducts('cold-beverages', 'right')">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- Smoothies Section -->
        <div class="category-section" data-category="Smoothies">
            <h3 class="category-title">
                <i class="fas fa-blender"></i> Smoothies
            </h3>
            <div class="products-container">
                <button class="scroll-btn scroll-left" onclick="scrollProducts('smoothies', 'left')">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="products-scroll" id="smoothies">
                    <div class="product-card" data-category="Smoothies">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/strawberry-smoothies.png') }}" alt="Strawberry Smoothies">
                        </div>
                        <div class="product-content">
                            <h4>Strawberry Smoothies</h4>
                            <div class="product-price">RM8.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(47)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(47)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Smoothies">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/lemonade-smoothies.png') }}" alt="Lemonade Smoothies">
                        </div>
                        <div class="product-content">
                            <h4>Lemonade Smoothies</h4>
                            <div class="product-price">RM8.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(48)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(48)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Smoothies">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/kiwi-smoothies.png') }}" alt="Kiwi Smoothies">
                        </div>
                        <div class="product-content">
                            <h4>Kiwi Smoothies</h4>
                            <div class="product-price">RM8.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(49)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(49)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Smoothies">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/orange-smoothies.png') }}" alt="Orange Smoothies">
                        </div>
                        <div class="product-content">
                            <h4>Orange Smoothies</h4>
                            <div class="product-price">RM8.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(50)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(50)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Smoothies">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/mango-smoothies.png') }}" alt="Mango Smoothies">
                        </div>
                        <div class="product-content">
                            <h4>Mango Smoothies</h4>
                            <div class="product-price">RM8.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(51)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(51)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="scroll-btn scroll-right" onclick="scrollProducts('smoothies', 'right')">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- Food Section -->
        <div class="category-section" data-category="Food">
            <h3 class="category-title">
                <i class="fas fa-utensils"></i> Food
            </h3>
            <div class="products-container">
                <button class="scroll-btn scroll-left" onclick="scrollProducts('food', 'left')">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="products-scroll" id="food">
                    <div class="product-card" data-category="Food">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/nasi-lemak-biasa.png') }}" alt="Nasi Lemak Biasa">
                        </div>
                        <div class="product-content">
                            <h4>Nasi Lemak Biasa</h4>
                            <div class="product-price">RM6.70</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(52)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(52)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Food">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/nasi-lemak-ayam-rendang.png') }}" alt="Nasi Lemak Ayam Rendang">
                        </div>
                        <div class="product-content">
                            <h4>Nasi Lemak Ayam Rendang</h4>
                            <div class="product-price">RM20.20</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(53)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(53)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Food">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/nasi-lemak-daging-rendang.png') }}" alt="Nasi Lemak Daging Rendang">
                        </div>
                        <div class="product-content">
                            <h4>Nasi Lemak Daging Rendang</h4>
                            <div class="product-price">RM20.20</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(54)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(54)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Food">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/nasi-ayam-masak-lemak-cili-padi.png') }}" alt="Nasi Ayam Masak Lemak Cili Padi">
                        </div>
                        <div class="product-content">
                            <h4>Nasi Ayam Masak Lemak Cili Padi</h4>
                            <div class="product-price">RM20.20</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(55)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(55)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Food">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/chicken-bolognese.png') }}" alt="Chicken Bolognese">
                        </div>
                        <div class="product-content">
                            <h4>Chicken Bolognese</h4>
                            <div class="product-price">RM16.10</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(56)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(56)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Food">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/beef-bolognese.png') }}" alt="Beef Bolognese">
                        </div>
                        <div class="product-content">
                            <h4>Beef Bolognese</h4>
                            <div class="product-price">RM16.10</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(57)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(57)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Food">
                        <div class="product-image">
                            <img src="{{ asset('images/caffe/salted-egg-prawn.png') }}" alt="Salted Egg Prawn">
                        </div>
                        <div class="product-content">
                            <h4>Salted Egg Prawn</h4>
                            <div class="product-price">RM26.90</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(58)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(58)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="scroll-btn scroll-right" onclick="scrollProducts('food', 'right')">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h3>About Richiamo Caffe</h3>
                <p>Authentic Italian coffee experience with premium quality beans and traditional brewing methods.</p>
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
                    <li><i class="fas fa-clock"></i> Mon-Fri: 7:00 A.M. – 10:00 P.M.</li>
                    <li><i class="fas fa-clock"></i> Sat-Sun: 8:00 A.M. – 11:00 P.M.</li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Contact Us</h3>
                <ul class="footer-links">
                    <li><a href="tel:+60123456789"><i class="fas fa-phone"></i> +60123456789</a></li>
                    <li><a href="mailto:info@richiamocaffe.com"><i class="fas fa-envelope"></i> info@richiamocaffe.com</a></li>
                    <li><a href="#" target="_blank"><i class="fab fa-instagram"></i> @richiamocaffe</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Richiamo Caffe - UTM Commerce Connect. All rights reserved.</p>
        </div>
    </footer>

    <script>
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

        // Dark mode toggle
        // Function moved to dark-mode.js

        // Close dropdown if clicked outside
        document.addEventListener('click', function(event) {
            const container = document.getElementById('profile-container');
            if (!container.contains(event.target)) {
                container.classList.remove('active');
            }
        });

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

        // Category filter
        function applyCategoryFilter() {
            const selectedCategory = document.getElementById('category-dropdown').value;
            const sections = document.querySelectorAll('.category-section');

            sections.forEach(section => {
                const sectionCategory = section.getAttribute('data-category');
                section.style.display = (selectedCategory === 'All' || sectionCategory === selectedCategory) ? 'block' : 'none';
            });
        }

        // Product filtering
        function filterProducts() {
            const searchQuery = document.getElementById('search-bar').value.toLowerCase();
            const products = document.querySelectorAll('.product-card');

            products.forEach(product => {
                const productName = product.querySelector('h4').textContent.toLowerCase();
                product.style.display = productName.includes(searchQuery) ? 'block' : 'none';
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
            fetch('{{ route('cart.count') }}')
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
            fetch('{{ route('wishlist.count') }}')
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
            // Get product details from the DOM
            let productCard = event ? event.target.closest('.product-card') : document.querySelector(`.product-card button[onclick*="addToCart(${productId})"]`).closest('.product-card');
            let productName = productCard.querySelector('h4').innerText;
            let productPrice = productCard.querySelector('.product-price').innerText.replace('RM', '').trim();

            console.log('Adding to cart:', {
                id: productId,
                name: productName,
                price: productPrice,
                vendor: 'richiamo'
            });

            fetch('{{ route('cart.add') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId,
                    vendor_type: 'richiamo',
                    name: productName,
                    price: parseFloat(productPrice)
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
            // Get product details from the DOM
            let productCard = event ? event.target.closest('.product-card') : document.querySelector(`.product-card button[onclick*="addToWishlist(${productId})"]`).closest('.product-card');
            let productName = productCard.querySelector('h4').innerText;
            let productPrice = productCard.querySelector('.product-price').innerText.replace('RM', '').trim();

            console.log('Adding to wishlist:', {
                id: productId,
                name: productName,
                price: productPrice,
                vendor: 'richiamo'
            });

            fetch('{{ route('wishlist.add') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId,
                    vendor_type: 'richiamo',
                    name: productName,
                    price: parseFloat(productPrice)
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
