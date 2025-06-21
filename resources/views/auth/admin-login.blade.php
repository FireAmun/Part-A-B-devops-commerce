<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - UTM Commerce Connect</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #60a5fa 100%);
            min-height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 2rem;
            animation: fadeInDown 0.8s ease-out;
        }

        .logo-section img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
            background: #fff;
            margin-bottom: 0.5rem;
            transition: transform 0.3s ease;
        }

        .logo-section h1 {
            color: #fff;
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            text-shadow: 0 4px 16px rgba(0,0,0,0.3);
        }

        .main-container {
            width: 90%;
            max-width: 450px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 16px 64px rgba(0,0,0,0.3);
            padding: 3rem 2.5rem;
            animation: fadeInUp 0.8s ease-out 0.3s both;
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1e3a8a;
            margin: 0 0 0.5rem 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .login-header p {
            color: #3b82f6;
            font-size: 1rem;
            margin: 0;
        }

        .notification {
            margin-bottom: 1.5rem;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: linear-gradient(90deg, #fef2f2 0%, #fee2e2 100%);
            color: #dc2626;
            border: 1px solid #fecaca;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #1e3a8a;
            font-size: 0.95rem;
        }

        .form-group input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #f3f4f6;
            box-sizing: border-box;
        }

        .form-group input:focus {
            outline: none;
            border-color: #1e3a8a;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(30, 58, 138, 0.1);
            transform: translateY(-2px);
        }

        .form-group i {
            position: absolute;
            left: 1rem;
            top: 2.5rem;
            color: #60a5fa;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .form-group input:focus + i {
            color: #1e3a8a;
        }

        .btn {
            width: 100%;
            padding: 1.25rem;
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #60a5fa 100%);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            margin-top: 1rem;
            position: relative;
            overflow: hidden;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(30, 58, 138, 0.3);
        }

        .back-link {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
        }

        .back-link a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .back-link a:hover {
            color: #1e3a8a;
            transform: translateX(-3px);
        }

        @media (max-width: 480px) {
            .main-container {
                width: 95%;
                padding: 2rem 1.5rem;
                margin: 0 1rem;
            }

            .logo-section h1 {
                font-size: 1.6rem;
            }

            .login-header h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="logo-section">
        <img src="{{ asset('images/logo-for-commerce.jpg') }}" alt="UTM Commerce Connect Logo">
        <h1>UTM Commerce Connect</h1>
    </div>

    <div class="main-container">
        <div class="login-header">
            <h2>
                <i class="fas fa-shield-alt"></i>
                Admin Login
            </h2>
            <p>Access the administration dashboard</p>
        </div>

        @if ($errors->any())
            <div class="notification">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        @if (session('message'))
            <div style="margin-bottom: 1.5rem; padding: 1rem 1.5rem; border-radius: 12px; font-size: 0.95rem; font-weight: 500; display: flex; align-items: center; gap: 0.75rem; background: linear-gradient(90deg, #ecfdf5 0%, #d1fae5 100%); color: #065f46; border: 1px solid #a7f3d0;">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('message') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="notification">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your admin email" />
                <i class="fas fa-envelope"></i>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required placeholder="Enter your password" />
                <i class="fas fa-lock"></i>
            </div>
            <button type="submit" class="btn">
                <i class="fas fa-sign-in-alt"></i>
                Login to Admin Panel
            </button>
        </form>

        <div class="back-link">
            <a href="{{ route('home') }}">
                <i class="fas fa-arrow-left"></i>
                Back to Home
            </a>
        </div>
    </div>
</body>
</html>
