<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | UTM Commerce Connect</title>
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
            --success: #10b981;
            --success-light: #d1fae5;
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

        .back-link {
            color: var(--text);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            transition: var(--transition);
        }

        .back-link:hover {
            color: var(--primary);
            transform: translateX(-5px);
        }

        .container {
            max-width: 800px;
            margin: 6rem auto 3rem;
            background: var(--white);
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: var(--shadow);
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .profile-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .profile-header h2 {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .profile-header p {
            color: var(--text-light);
            font-size: 1.1rem;
        }

        .success-message {
            background-color: var(--success-light);
            color: var(--success);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .success-message i {
            font-size: 1.25rem;
        }

        .form-group {
            margin-bottom: 2rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.75rem;
            font-weight: 600;
            color: var(--text);
            font-size: 1.1rem;
        }

        .form-group input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            font-size: 1rem;
            transition: var(--transition);
            background: var(--gray-100);
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .form-group i {
            position: absolute;
            left: 1rem;
            top: 2.8rem;
            color: var(--text-light);
            font-size: 1.25rem;
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            width: 100%;
            padding: 1rem;
            background-color: var(--primary);
            color: var(--white);
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn:hover {
            background-color: var(--primary-light);
            transform: translateY(-2px);
        }

        .btn i {
            font-size: 1.25rem;
        }

        footer {
            background: var(--primary);
            color: var(--white);
            padding: 2rem;
            margin-top: auto;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 1rem;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
            }

            .container {
                margin: 5rem 1rem 2rem;
                padding: 1.5rem;
            }

            .profile-header h2 {
                font-size: 1.75rem;
            }

            .form-group input {
                padding: 0.875rem 0.875rem 0.875rem 2.75rem;
            }

            .form-group i {
                top: 2.6rem;
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

        .dark-mode .back-link {
            color: #e5e5e5;
        }

        .dark-mode .back-link:hover {
            color: var(--primary-light);
        }

        .dark-mode .container {
            background: #2d2d2d;
        }

        .dark-mode .form-group label {
            color: #e5e5e5;
        }

        .dark-mode .form-group input {
            background: #404040;
            border-color: #4b5563;
            color: #e5e5e5;
        }

        .dark-mode .form-group input:focus {
            background: #2d2d2d;
        }

        .dark-mode .form-group i {
            color: #a0a0a0;
        }

        .dark-mode footer {
            background: #1a1a1a;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>UTM Commerce Connect</h1>
        <a href="/home" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Back to Home
        </a>
    </nav>

    <div class="container">
        <div class="profile-header">
            <h2>Update Profile</h2>
            <p>Keep your information up to date for a better shopping experience</p>
        </div>

        @if (session('success'))
            <div class="success-message">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Full Name</label>
                <i class="fas fa-user"></i>
                <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" required placeholder="Enter your full name">
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" required placeholder="Enter your email address">
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <i class="fas fa-phone"></i>
                <input type="text" id="phone" name="phone" value="{{ Auth::user()->phone }}" required placeholder="Enter your phone number">
            </div>

            <button type="submit" class="btn">
                <i class="fas fa-save"></i>
                Update Profile
            </button>
        </form>
    </div>

    <footer>
        <div class="footer-bottom">
            &copy; 2024 UTM Commerce Connect. All rights reserved.
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
    </script>
</body>
</html>
