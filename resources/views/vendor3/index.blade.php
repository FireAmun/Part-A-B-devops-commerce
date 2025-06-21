<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setepak Printing Service KTF - UTM Commerce Connect</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #16a34a;
            --primary-light: #22c55e;
            --secondary: #4ade80;
            --accent: #86efac;
            --text: #064e3b;
            --text-light: #059669;
            --white: #ffffff;
            --light-green: #f0fdf4;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --shadow: 0 10px 25px rgba(22, 163, 74, 0.15);
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
            color: var(--text);
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
            background: linear-gradient(rgba(22, 163, 74, 0.8), rgba(22, 163, 74, 0.8)), url('https://images.unsplash.com/photo-1586953208448-b95a79798f07?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') no-repeat center center/cover;
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
            background: var(--light-green);
        }

        .search-bar input:focus {
            outline: none;
            border-color: var(--primary);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(22, 163, 74, 0.1);
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
            background: var(--light-green);
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
            box-shadow: 0 20px 40px rgba(22, 163, 74, 0.2);
        }

        .product-image {
            height: 180px;
            overflow: hidden;
            position: relative;
            background: var(--light-green);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image img {
            width: 80%;
            height: 80%;
            object-fit: contain;
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
            background: var(--light-green);
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
            color: #22c55e;
        }

        .dark-mode .nav-icon {
            color: #e5e5e5;
        }

        .dark-mode .nav-icon:hover {
            color: #22c55e;
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
            color: #22c55e;
        }

        .dark-mode .hero {
            background: linear-gradient(rgba(22, 163, 74, 0.9), rgba(22, 163, 74, 0.9)), url('https://images.unsplash.com/photo-1586953208448-b95a79798f07?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') no-repeat center center/cover;
        }

        .dark-mode .filter-section,
        .dark-mode .product-card {
            background: #2d2d2d;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .dark-mode .search-bar input,
        .dark-mode .category-select {
            background: #404040;
            border-color: #4b5563;
            color: #e5e5e5;
        }

        .dark-mode .search-bar input:focus,
        .dark-mode .category-select:focus {
            background: #374151;
            border-color: #22c55e;
        }

        .dark-mode .product-content h4 {
            color: #e5e5e5;
        }

        .dark-mode .category-title {
            color: #22c55e;
            border-bottom-color: #4ade80;
        }

        .dark-mode .product-image {
            background: #374151;
        }

        .dark-mode .btn-secondary {
            background: #374151;
            color: #22c55e;
            border-color: #4ade80;
        }

        .dark-mode .btn-secondary:hover {
            background: #4ade80;
            color: #064e3b;
        }

        .dark-mode .products-scroll::-webkit-scrollbar-track {
            background: #404040;
        }

        .dark-mode .products-scroll::-webkit-scrollbar-thumb {
            background: #22c55e;
        }

        .dark-mode footer {
            background: #1a1a1a;
        }

        .dark-mode .welcome h2 {
            color: #22c55e;
        }

        .dark-mode .section-title {
            color: #22c55e;
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

        .dark-mode .toast {
            background: #22c55e;
            color: #064e3b;
        }

        .dark-mode .toast.success {
            background: #059669;
            color: #ffffff;
        }

        .dark-mode .toast.error {
            background: #dc2626;
            color: #ffffff;
        }
    </style>
</head>
<body class="fade-in">
    <nav class="navbar">
        <h1>Setepak Printing Service KTF</h1>
        <div class="navbar-right">
            <div class="nav-icons">
                <a href="{{ route('vendor3.wishlist.view') }}" class="nav-icon" id="wishlist-icon">
                    <i class="fas fa-heart"></i>
                    <span class="badge" id="wishlist-count">0</span>
                </a>
                <a href="{{ route('vendor3.cart.view') }}" class="nav-icon" id="cart-icon">
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
        <h1>Welcome to Setepak Printing Service KTF</h1>
        <p>Professional printing solutions for all your academic and business needs.</p>
    </section>

    <div class="container">
        <a href="{{ route('home') }}" style="display:inline-block; margin-bottom:1.5rem; background:#e5e7eb; color:#16a34a; border:none; border-radius:6px; padding:0.5rem 1.2rem; cursor:pointer; font-weight:500; text-decoration:none;">
            <i class="fas fa-arrow-left"></i> Back to Vendors
        </a>
        <div class="welcome">
            <h2>Your Printing Partner!</h2>
            <p>Quality printing services with fast turnaround times and competitive prices.</p>
        </div>

        <div class="filter-section">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" id="search-bar" placeholder="Search for printing services..." oninput="filterProducts()">
            </div>
            <div class="filter-controls">
                <select id="category-dropdown" class="category-select">
                    <option value="All">All Services</option>
                    <option value="Printing Services">Printing Services</option>
                    <option value="Business Cards">Business Cards</option>
                    <option value="Banners & Posters">Banners & Posters</option>
                    <option value="Stickers & Labels">Stickers & Labels</option>
                    <option value="T-shirt Printing">T-shirt Printing</option>
                    <option value="Custom Packaging">Custom Packaging</option>
                </select>
                <button onclick="applyCategoryFilter()" class="filter-btn">
                    <i class="fas fa-filter"></i>
                    Apply Filter
                </button>
            </div>
        </div>

        <!-- Printing Services Section -->
        <div class="category-section" data-category="Printing Services">
            <h3 class="category-title">
                <i class="fas fa-print"></i> Document Printing Services
            </h3>
            <div class="products-container">
                <button class="scroll-btn scroll-left" onclick="scrollProducts('printing-services', 'left')">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="products-scroll" id="printing-services">
                    <div class="product-card" data-category="Printing Services">
                        <div class="product-image">
                            <i class="fas fa-file-alt" style="font-size: 4rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-content">
                            <h4>A4 Black & White Prints</h4>
                            <div class="product-price">RM1.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(60)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(60)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Printing Services">
                        <div class="product-image">
                            <i class="fas fa-file-image" style="font-size: 4rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-content">
                            <h4>A4 Color Prints</h4>
                            <div class="product-price">RM5.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(61)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(61)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Printing Services">
                        <div class="product-image">
                            <i class="fas fa-expand-arrows-alt" style="font-size: 4rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-content">
                            <h4>A3 Black & White Prints</h4>
                            <div class="product-price">RM3.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(62)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(62)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Printing Services">
                        <div class="product-image">
                            <i class="fas fa-palette" style="font-size: 4rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-content">
                            <h4>A3 Color Prints</h4>
                            <div class="product-price">RM10.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(63)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(63)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Printing Services">
                        <div class="product-image">
                            <i class="fas fa-copy" style="font-size: 4rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-content">
                            <h4>Photocopying - Black & White</h4>
                            <div class="product-price">RM0.10</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(64)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(64)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Printing Services">
                        <div class="product-image">
                            <i class="fas fa-images" style="font-size: 4rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-content">
                            <h4>Photocopying - Color</h4>
                            <div class="product-price">RM0.50</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(65)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(65)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="scroll-btn scroll-right" onclick="scrollProducts('printing-services', 'right')">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- Business Cards Section -->
        <div class="category-section" data-category="Business Cards">
            <h3 class="category-title">
                <i class="fas fa-address-card"></i> Business Cards
            </h3>
            <div class="products-container">
                <button class="scroll-btn scroll-left" onclick="scrollProducts('business-cards', 'left')">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="products-scroll" id="business-cards">
                    <div class="product-card" data-category="Business Cards">
                        <div class="product-image">
                            <i class="fas fa-id-card" style="font-size: 4rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-content">
                            <h4>Business Cards - Basic Set</h4>
                            <div class="product-price">RM20.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(66)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(66)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Business Cards">
                        <div class="product-image">
                            <i class="fas fa-star" style="font-size: 4rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-content">
                            <h4>Business Cards - Premium Set</h4>
                            <div class="product-price">RM100.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(67); return false;">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(67); return false;">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="scroll-btn scroll-right" onclick="scrollProducts('business-cards', 'right')">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- Banners & Posters Section -->
        <div class="category-section" data-category="Banners & Posters">
            <h3 class="category-title">
                <i class="fas fa-flag"></i> Banners & Posters
            </h3>
            <div class="products-container">
                <button class="scroll-btn scroll-left" onclick="scrollProducts('banners-posters', 'left')">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="products-scroll" id="banners-posters">
                    <div class="product-card" data-category="Banners & Posters">
                        <div class="product-image">
                            <i class="fas fa-rectangle-landscape" style="font-size: 4rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-content">
                            <h4>Small Banner</h4>
                            <div class="product-price">RM30.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(68)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(68)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Banners & Posters">
                        <div class="product-image">
                            <i class="fas fa-panorama" style="font-size: 4rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-content">
                            <h4>Large Banner</h4>
                            <div class="product-price">RM200.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(69)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(69)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Banners & Posters">
                        <div class="product-image">
                            <i class="fas fa-file-pdf" style="font-size: 4rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-content">
                            <h4>Flyers - Small Batch</h4>
                            <div class="product-price">RM50.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(70)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(70)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Banners & Posters">
                        <div class="product-image">
                            <i class="fas fa-book-open" style="font-size: 4rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-content">
                            <h4>Brochures - Large Batch</h4>
                            <div class="product-price">RM300.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(71)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(71)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="scroll-btn scroll-right" onclick="scrollProducts('banners-posters', 'right')">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- Stickers & Labels Section -->
        <div class="category-section" data-category="Stickers & Labels">
            <h3 class="category-title">
                <i class="fas fa-tags"></i> Stickers & Labels
            </h3>
            <div class="products-container">
                <button class="scroll-btn scroll-left" onclick="scrollProducts('stickers-labels', 'left')">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="products-scroll" id="stickers-labels">
                    <div class="product-card" data-category="Stickers & Labels">
                        <div class="product-image">
                            <i class="fas fa-tag" style="font-size: 4rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-content">
                            <h4>Stickers & Labels - Small</h4>
                            <div class="product-price">RM0.50</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(72)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(72)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Stickers & Labels">
                        <div class="product-image">
                            <i class="fas fa-tags" style="font-size: 4rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-content">
                            <h4>Stickers & Labels - Large</h4>
                            <div class="product-price">RM5.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(73)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(73)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="scroll-btn scroll-right" onclick="scrollProducts('stickers-labels', 'right')">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- T-shirt Printing Section -->
        <div class="category-section" data-category="T-shirt Printing">
            <h3 class="category-title">
                <i class="fas fa-tshirt"></i> T-shirt Printing
            </h3>
            <div class="products-container">
                <button class="scroll-btn scroll-left" onclick="scrollProducts('tshirt-printing', 'left')">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="products-scroll" id="tshirt-printing">
                    <div class="product-card" data-category="T-shirt Printing">
                        <div class="product-image">
                            <i class="fas fa-tshirt" style="font-size: 4rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-content">
                            <h4>T-shirt Printing - Basic</h4>
                            <div class="product-price">RM20.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(74)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(74)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="T-shirt Printing">
                        <div class="product-image">
                            <i class="fas fa-shirt" style="font-size: 4rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-content">
                            <h4>T-shirt Printing - Premium</h4>
                            <div class="product-price">RM50.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(75)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(75)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="scroll-btn scroll-right" onclick="scrollProducts('tshirt-printing', 'right')">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- Custom Packaging Section -->
        <div class="category-section" data-category="Custom Packaging">
            <h3 class="category-title">
                <i class="fas fa-box"></i> Custom Packaging
            </h3>
            <div class="products-container">
                <button class="scroll-btn scroll-left" onclick="scrollProducts('custom-packaging', 'left')">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="products-scroll" id="custom-packaging">
                    <div class="product-card" data-category="Custom Packaging">
                        <div class="product-image">
                            <i class="fas fa-box-open" style="font-size: 4rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-content">
                            <h4>Custom Packaging - Simple</h4>
                            <div class="product-price">RM5.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(76)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(76)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="product-card" data-category="Custom Packaging">
                        <div class="product-image">
                            <i class="fas fa-cube" style="font-size: 4rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-content">
                            <h4>Custom Packaging - Complex</h4>
                            <div class="product-price">RM50.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary" onclick="addToCart(77)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                                <button class="btn btn-secondary" onclick="addToWishlist(77)">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="scroll-btn scroll-right" onclick="scrollProducts('custom-packaging', 'right')">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h3>About Setepak Printing Service KTF</h3>
                <p>Professional printing services with over 10 years of experience. Quality guaranteed with fast turnaround times.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
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
                <h3>Our Services</h3>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Document Printing</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Business Cards</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Banners & Posters</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> T-shirt Printing</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Working Hours</h3>
                <ul class="footer-links">
                    <li><i class="fas fa-clock"></i> Mon-Fri: 8:00 A.M. – 6:00 P.M.</li>
                    <li><i class="fas fa-clock"></i> Sat: 9:00 A.M. – 4:00 P.M.</li>
                    <li><i class="fas fa-clock"></i> Sun: Closed</li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Contact Us</h3>
                <ul class="footer-links">
                    <li><a href="mailto:setepakprintingservicektf@gmail.com"><i class="fas fa-envelope"></i> setepakprintingservicektf@gmail.com</a></li>
                    <li><a href="tel:+60123456789"><i class="fas fa-phone"></i> +60123456789</a></li>
                    <li><a href="#" target="_blank"><i class="fab fa-whatsapp"></i> WhatsApp Us</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Setepak Printing Service KTF - UTM Commerce Connect. All rights reserved.</p>
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
        // Dark mode functionality is now in a separate JS file
        // Look for dark-mode.js being included at the bottom of the page

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
                vendor: 'vendor3'
            });

            fetch('{{ route('cart.add') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId,
                    vendor_type: 'vendor3',
                    name: productName,
                    price: parseFloat(productPrice)
                })
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById('cart-count').textContent = data.count;
                showToast('Service added to cart successfully!');
            })
            .catch(error => {
                console.error('Error adding to cart:', error);
                showToast('Failed to add service to cart', 'error');
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
                vendor: 'vendor3'
            });

            fetch('{{ route('wishlist.add') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId,
                    vendor_type: 'vendor3',
                    name: productName,
                    price: parseFloat(productPrice)
                })
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById('wishlist-count').textContent = data.count;
                showToast('Service added to wishlist!');
            })
            .catch(error => {
                console.error('Error adding to wishlist:', error);
                showToast('Failed to add service to wishlist', 'error');
            });
        }
    </script>
    <!-- Dark mode script -->
    <script src="{{ asset('js/dark-mode.js') }}"></script>
</body>
</html>
