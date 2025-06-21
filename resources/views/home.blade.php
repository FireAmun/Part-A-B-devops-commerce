<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTM Commerce Connect</title>
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

        .search-bar {
            position: relative;
            width: 300px;
        }

        .search-bar input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 2px solid var(--gray-200);
            border-radius: 25px;
            font-size: 0.95rem;
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
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') no-repeat center center/cover;
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

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--primary);
            color: var(--white);
            border: none;
        }

        .btn-primary:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: transparent;
            color: var(--white);
            border: 2px solid var(--white);
        }

        .btn-secondary:hover {
            background: var(--white);
            color: var(--primary);
            transform: translateY(-2px);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-title h2 {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .section-title p {
            color: var(--text-light);
            max-width: 600px;
            margin: 0 auto;
        }

        .vendor-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .vendor-card {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            position: relative;
        }

        .vendor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .vendor-image {
            height: 200px;
            overflow: hidden;
            position: relative;
        }

        .vendor-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .vendor-card:hover .vendor-image img {
            transform: scale(1.1);
        }

        .vendor-content {
            padding: 1.5rem;
        }

        .vendor-content h3 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            color: var(--text);
        }

        .vendor-content p {
            color: var(--text-light);
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }

        .vendor-stats {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .stat {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .stat i {
            color: var(--primary);
        }

        .vendor-actions {
            display: flex;
            gap: 0.5rem;
        }

        .vendor-actions .btn {
            flex: 1;
            justify-content: center;
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }

        .features {
            background: var(--gray-100);
            padding: 4rem 0;
            margin: 4rem 0;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .feature-card {
            text-align: center;
            padding: 2rem;
            background: var(--white);
            border-radius: 15px;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: var(--primary);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 1.5rem;
        }

        .feature-card h3 {
            margin-bottom: 1rem;
            color: var(--text);
        }

        .feature-card p {
            color: var(--text-light);
            font-size: 0.95rem;
            line-height: 1.6;
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

            .search-bar {
                display: none;
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

            .hero-buttons {
                flex-direction: column;
            }

            .container {
                padding: 1rem;
            }

            .vendor-grid {
                grid-template-columns: 1fr;
            }

            .features-grid {
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

        .dark-mode .search-bar input {
            background: #2d2d2d;
            border-color: #404040;
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

        .dark-mode .vendor-card {
            background: #2d2d2d;
        }

        .dark-mode .vendor-content h3 {
            color: #e5e5e5;
        }

        .dark-mode .vendor-content p {
            color: #a0a0a0;
        }

        .dark-mode .features {
            background: #1a1a1a;
        }

        .dark-mode .feature-card {
            background: #2d2d2d;
        }

        .dark-mode .feature-card h3 {
            color: #e5e5e5;
        }

        .dark-mode .feature-card p {
            color: #a0a0a0;
        }

        .dark-mode footer {
            background: #1a1a1a;
        }
    </style>
</head>
<body class="fade-in">
    <!-- Include the chatbot component -->
    @include('components.chatbot')

    <nav class="navbar">
        <h1>UTM Commerce Connect</h1>
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
                    <a href="/profile">
                        <i class="fas fa-user"></i>
                        Profile
                    </a>
                    <a href="/orders">
                        <i class="fas fa-shopping-bag"></i>
                        Orders
                    </a>
                    <a href="/wishlist">
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
        <h1>Welcome to UTM Commerce Connect</h1>
        <p>Your one-stop platform for campus deals and services. Discover amazing vendors, exclusive offers, and convenient shopping experiences.</p>
        <div class="hero-buttons">
            <a href="#vendors" class="btn btn-primary">
                <i class="fas fa-store"></i>
                Explore Vendors
            </a>
            <a href="#features" class="btn btn-secondary">
                <i class="fas fa-info-circle"></i>
                Learn More
            </a>
        </div>
    </section>

    <div class="container">
        <section id="vendors" class="section-title">
            <h2>Featured Vendors</h2>
            <p>Discover our curated selection of campus vendors offering the best products and services.</p>
        </section>

        <div class="vendor-grid">
            <div class="vendor-card">
                <div class="vendor-image">
                    <img src="https://images.unsplash.com/photo-1604719312566-8912e9227c6a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="UTM Mart">
                </div>
                <div class="vendor-content">
                    <h3>UTM Mart</h3>
                    <p>Your campus convenience store with a wide range of products.</p>
                    <div class="vendor-stats">
                        <div class="stat">
                            <i class="fas fa-star"></i>
                            <span>4.8 (120 reviews)</span>
                        </div>
                        <div class="stat">
                            <i class="fas fa-clock"></i>
                            <span>Open Now</span>
                        </div>
                    </div>
                    <div class="vendor-actions">
                        <a href="{{ route('vendor.index') }}" class="btn btn-primary">Visit Store</a>
                    </div>
                </div>
            </div>

            <div class="vendor-card">
                <div class="vendor-image">
                    <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Setepak Printing Service KTF">
                </div>
                <div class="vendor-content">
                    <h3>Setepak Printing Service KTF</h3>
                    <p>Professional printing services for all your academic needs.</p>
                    <div class="vendor-stats">
                        <div class="stat">
                            <i class="fas fa-star"></i>
                            <span>4.9 (85 reviews)</span>
                        </div>
                        <div class="stat">
                            <i class="fas fa-clock"></i>
                            <span>Open Now</span>
                        </div>
                    </div>
                    <div class="vendor-actions">
                        <a href="{{ route('vendor3.index') }}" class="btn btn-primary">Visit Store</a>
                    </div>
                </div>
            </div>

            <div class="vendor-card">
                <div class="vendor-image">
                    <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Richiamo Coffee">
                </div>
                <div class="vendor-content">
                    <h3>Richiamo Caffe</h3>
                    <p>Premium coffee and delicious treats for your study breaks.</p>
                    <div class="vendor-stats">
                        <div class="stat">
                            <i class="fas fa-star"></i>
                            <span>4.7 (150 reviews)</span>
                        </div>
                        <div class="stat">
                            <i class="fas fa-clock"></i>
                            <span>Open Now</span>
                        </div>
                    </div>
                    <div class="vendor-actions">
                        <a href="{{ route('vendor2.index') }}" class="btn btn-primary">Visit Store</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="features" id="features">
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <h3>Fast Delivery</h3>
                <p>Quick and reliable delivery services across campus.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Secure Payments</h3>
                <p>Safe and secure payment processing for all transactions.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3>24/7 Support</h3>
                <p>Round-the-clock customer support for all your needs.</p>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h3>About UTM Commerce Connect</h3>
                <p>Your trusted platform for campus commerce, connecting students with local vendors for a seamless shopping experience.</p>
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
                <h3>Contact Us</h3>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-map-marker-alt"></i> UTM Campus, Johor Bahru</a></li>
                    <li><a href="#"><i class="fas fa-phone"></i> +60 116 415 3312</a></li>
                    <li><a href="#"><i class="fas fa-envelope"></i>utmcommerceconnect@gmail.com
</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 UTM Commerce Connect. All rights reserved.</p>
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

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
    <!-- Dark mode script -->
    <script src="{{ asset('js/dark-mode.js') }}"></script>
</body>
</html>
