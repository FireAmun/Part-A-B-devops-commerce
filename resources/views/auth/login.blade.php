<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login | UTM Commerce Connect</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #1e3a8a;
            --primary-dark: #16275c;
            --primary-light: #2563eb;
            --secondary: #111827;
            --secondary-dark: #000000;
            --accent: #f59e0b;
            --accent-light: #f3f4f6;
            --text: #1f2937;
            --text-light: #6b7280;
            --white: #ffffff;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --success: #10b981;
            --success-light: #d1fae5;
            --error: #ef4444;
            --error-light: #fee2e2;
            --shadow: 0 10px 25px rgba(30, 58, 138, 0.08);
            --shadow-lg: 0 20px 40px rgba(30, 58, 138, 0.12);
            --transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Figtree', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary-light), var(--white));
            padding: 2rem;
        }

        .main-container {
            display: flex;
            width: 90%;
            max-width: 1200px;
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            backdrop-filter: blur(10px);
            position: relative;
            animation: fadeIn 0.6s ease-out;
        }

            .left-panel {
                flex: 1;
                background: linear-gradient(135deg, #2a4db2, #3a5093);
                padding: 3rem 2rem;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                color: var(--white);
                position: relative;
                overflow: hidden;
            }

        .left-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><rect width="1" height="1" fill="rgba(255,255,255,0.10)"/></svg>');
            opacity: 0.08;
        }

        .logo-container {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            align-items: center;
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
        }

        .logo-container img {
            width: 180px;
            height: auto;
            transition: var(--transition);
        }

        .logo-container img:first-child {
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(30, 58, 138, 0.12);
        }

        .logo-container img:hover {
            transform: scale(1.05);
        }

        .left-panel h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
            text-align: center;
            color: var(--white);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.12);
        }

        .left-panel p {
            font-size: 1.1rem;
            text-align: center;
            max-width: 400px;
            line-height: 1.6;
            opacity: 0.95;
            color: rgba(255, 255, 255, 0.95);
        }

        .login-form {
            flex: 1;
            padding: 3rem;
            background: var(--white);
        }

        .login-form h1 {
            text-align: center;
            color: var(--primary);
            margin-bottom: 2.5rem;
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text);
            font-size: 0.95rem;
        }

        .form-group input {
            width: 100%;
            padding: 1rem;
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            font-size: 1rem;
            transition: var(--transition);
            background: var(--gray-100);
            color: var(--text);
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.08);
        }

        .form-group i {
            position: absolute;
            right: 1rem;
            top: 2.5rem;
            color: var(--text-light);
        }

        .btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border: none;
            border-radius: 12px;
            color: var(--white);
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 1rem;
            box-shadow: 0 4px 12px rgba(30, 58, 138, 0.10);
        }

        .btn:hover {
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(30, 58, 138, 0.16);
        }

        .text-center {
            text-align: center;
            margin-top: 2rem;
        }

        .text-center p {
            margin-bottom: 1rem;
            color: var(--text-light);
        }

        .text-center a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            position: relative;
        }

        .text-center a::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
        }

        .text-center a:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        .text-center a:hover {
            color: var(--primary-dark);
        }

        .button-container {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 1.5rem;
        }

        .btn.small-btn {
            flex: 1;
            padding: 0.75rem 1.5rem;
            font-size: 0.95rem;
            background: var(--gray-100);
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 10px;
            text-decoration: none;
            text-align: center;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn.small-btn:hover {
            background: var(--primary);
            color: var(--white);
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30, 58, 138, 0.12);
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .main-container {
                flex-direction: column;
                width: 100%;
                background: var(--white);
            }

            .left-panel {
                padding: 2rem 1rem;
            }

            .login-form {
                padding: 2rem 1.5rem;
            }

            .logo-container {
                flex-direction: column;
                gap: 1rem;
            }

            .logo-container img {
                width: 140px;
            }

            .button-container {
                flex-direction: column;
            }

            .btn.small-btn {
                width: 100%;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="left-panel">
            <div class="logo-container">
                <img src="{{ asset('images/logo-for-commerce.jpg') }}" alt="Commerce Logo">
                <img src="{{ asset('images/utm-logo.png') }}" alt="UTM Logo">
            </div>
            <h2>Welcome Back!</h2>
            <p>UTM Commerce Connect is your gateway to student entrepreneurship and local commerce. Sign in to access your account.</p>
        </div>
        <div class="login-form">
            <h1>Sign In</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input id="email" type="email" name="email" required autofocus placeholder="Enter your email" />
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required placeholder="Enter your password" />
                    <i class="fas fa-lock"></i>
                </div>
                <button type="submit" class="btn">Sign In</button>
            </form>
            <div class="text-center">
                <p><a href="{{ route('password.request') }}">Forgot your password?</a></p>
                <p>Don't have an account? <a href="{{ route('register') }}">Create one now</a></p>
                <div class="button-container">
                    <a href="{{ route('vendor.select') }}" class="btn small-btn">
                        <i class="fas fa-store"></i> Vendor Login
                    </a>
                    <a href="{{ route('admin.login') }}" class="btn small-btn">
                        <i class="fas fa-user-shield"></i> Admin Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
