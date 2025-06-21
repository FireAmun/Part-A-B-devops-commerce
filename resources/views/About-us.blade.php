<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - UTM Commerce Connect</title>
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

        .container {
            max-width: 1000px;
            margin: 100px auto 40px;
            padding: 0 2rem;
        }

        .hero-section {
            text-align: center;
            margin-bottom: 4rem;
        }

        .hero-section h1 {
            color: var(--primary);
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .hero-section p {
            color: var(--text-light);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .about-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .about-card {
            background: var(--white);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .about-card:hover {
            transform: translateY(-5px);
        }

        .about-card i {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .about-card h2 {
            color: var(--primary);
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        .about-card p {
            color: var(--text-light);
            line-height: 1.6;
        }

        .team-section {
            text-align: center;
            margin-bottom: 4rem;
        }

        .team-section h2 {
            color: var(--primary);
            font-size: 2rem;
            margin-bottom: 2rem;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .team-member {
            background: var(--white);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .team-member:hover {
            transform: translateY(-5px);
        }

        .team-member img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 1rem;
            object-fit: cover;
            border: 3px solid var(--primary);
        }

        .team-member h3 {
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .team-member p {
            color: var(--text-light);
            margin-bottom: 1rem;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .social-links a {
            color: var(--text-light);
            font-size: 1.25rem;
            transition: var(--transition);
        }

        .social-links a:hover {
            color: var(--primary);
            transform: translateY(-3px);
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

            .container {
                margin: 80px 1rem 2rem;
                padding: 0 1rem;
            }

            .hero-section h1 {
                font-size: 2rem;
            }

            .about-grid,
            .team-grid {
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

        .dark-mode .about-card,
        .dark-mode .team-member {
            background: #2d2d2d;
        }

        .dark-mode .about-card h2,
        .dark-mode .team-member h3 {
            color: #e5e5e5;
        }

        .dark-mode .about-card p,
        .dark-mode .team-member p {
            color: #a0a0a0;
        }

        .dark-mode footer {
            background: #1a1a1a;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="{{ url('/home') }}" style="text-decoration:none; color:inherit;">
            <h1>UTM Commerce Connect</h1>
        </a>
        <div class="navbar-right">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search vendors, products...">
            </div>
            <div class="nav-icons">
                <!-- Removed wishlist and cart icons -->
            </div>
            <div class="dark-mode-toggle" id="dark-mode-toggle" onclick="toggleDarkMode()">
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

    <div class="container">
        <div class="hero-section">
            <h1>About UTM Commerce Connect</h1>
            <p>Connecting UTM students with local vendors for a seamless campus shopping experience.</p>
        </div>

        <div class="about-grid">
            <div class="about-card">
                <i class="fas fa-bullseye"></i>
                <h2>Our Mission</h2>
                <p>To create a vibrant marketplace that connects UTM students with local vendors, making campus commerce more accessible and efficient.</p>
            </div>
            <div class="about-card">
                <i class="fas fa-eye"></i>
                <h2>Our Vision</h2>
                <p>To become the leading platform for campus commerce, fostering community growth and supporting local businesses.</p>
            </div>
            <div class="about-card">
                <i class="fas fa-handshake"></i>
                <h2>Our Values</h2>
                <p>We believe in transparency, community support, and creating value for both students and vendors through innovative solutions.</p>
            </div>
        </div>

        <div class="team-section">
            <h2>Developer</h2>
            <div class="team-grid">
                <div class="team-member">
                    <img src="https://img.icons8.com/fluency/96/user-male-circle.png" alt="Amar Hassan">
                    <h3>Amar Hassan</h3>
                    <p>Software Engineer</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    <li><a href="#"><i class="fas fa-envelope"></i> utmcommerceconnect@gmail.com</a></li>
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
        function toggleDarkMode() {
            const body = document.body;
            const toggle = document.getElementById('dark-mode-toggle');
            body.classList.toggle('dark-mode');
            toggle.classList.toggle('active');
        }

        // Close dropdown if clicked outside
        document.addEventListener('click', function(event) {
            const container = document.getElementById('profile-container');
            if (!container.contains(event.target)) {
                container.classList.remove('active');
            }
        });
    </script>
</body>
</html>
