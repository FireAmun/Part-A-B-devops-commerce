<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Vendor Login | UTM Commerce Connect</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --secondary: #3b82f6;
            --text: #1f2937;
            --text-light: #6b7280;
            --white: #ffffff;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
            --success: #059669;
            --error: #dc2626;
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
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 2rem;
        }

        .main-container {
            display: flex;
            width: 90%;
            max-width: 1000px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
            animation: fadeIn 0.6s ease-out;
        }

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

        .left-panel {
            flex: 1;
            background: rgba(255, 255, 255, 0.1);
            padding: 3rem 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--white);
            text-align: center;
        }

        .logo-container {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            align-items: center;
            margin-bottom: 2rem;
        }

        .logo-container img {
            width: 180px;
            height: auto;
            transition: var(--transition);
        }

        .logo-container img:first-child {
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .logo-container img:hover {
            transform: scale(1.05);
        }

        .left-panel h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .left-panel p {
            font-size: 1.1rem;
            line-height: 1.6;
            max-width: 400px;
            opacity: 0.9;
        }

        .login-form {
            flex: 1;
            background: var(--white);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-form h1 {
            font-size: 2rem;
            text-align: center;
            color: var(--primary);
            margin-bottom: 2rem;
            font-weight: 700;
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
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
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
            background: var(--primary);
            border: none;
            border-radius: 12px;
            color: var(--white);
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
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
        }

        .text-center a:hover {
            color: var(--primary-dark);
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow);
            font-size: 0.95rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            z-index: 1000;
            animation: slideIn 0.3s ease-out;
        }

        .notification i {
            font-size: 1.25rem;
        }

        .notification-success {
            background-color: #ecfdf5;
            color: var(--success);
            border: 1px solid #a7f3d0;
        }

        .notification-error {
            background-color: #fef2f2;
            color: var(--error);
            border: 1px solid #fecaca;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        .notification.hide {
            animation: slideOut 0.3s ease-in forwards;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .main-container {
                flex-direction: column;
            }

            .left-panel {
                padding: 2rem 1.5rem;
            }

            .login-form {
                padding: 2rem 1.5rem;
            }

            .logo-container {
                flex-direction: column;
                gap: 1rem;
            }

            .logo-container img {
                width: 150px;
            }

            .notification {
                left: 1rem;
                right: 1rem;
                top: 1rem;
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
            <h2>Welcome, Vendor!</h2>
            <p>UTM Commerce Connect is your gateway to managing your business and connecting with customers. Access your vendor dashboard to manage products, orders, and grow your business.</p>
        </div>
        <div class="login-form">
            <h1>Vendor Login</h1>
            @if ($errors->any())
                <div class="notification notification-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif
            @if(isset($vendor))
                <h2 style="text-align:center;">Login for {{ $vendor->name }}</h2>
            @endif
            <form method="POST" action="{{ route('vendor.login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input id="email" type="email" name="email" required autofocus placeholder="Enter your email address" />
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required placeholder="Enter your password" />
                    <i class="fas fa-lock"></i>
                </div>
                <button type="submit" class="btn">
                    <i class="fas fa-sign-in-alt"></i> Log In
                </button>
            </form>

        </div>
    </div>

    <script>
        // Auto-hide notifications
        document.querySelectorAll('.notification').forEach(notification => {
            setTimeout(() => {
                notification.classList.add('hide');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 4000);
        });
    </script>
</body>
</html>
