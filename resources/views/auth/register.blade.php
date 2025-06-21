<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | UTM Commerce Connect</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
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
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 2rem;
        }

        .register-container {
            background: var(--white);
            padding: 3rem;
            border-radius: 20px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 500px;
            color: var(--text);
            position: relative;
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

        .register-container h1 {
            font-size: 2rem;
            margin-bottom: 2rem;
            text-align: center;
            color: var(--primary);
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
            margin-top: 1rem;
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

        .password-requirements {
            margin-top: 0.5rem;
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .password-requirements ul {
            list-style: none;
            padding-left: 0;
            margin-top: 0.5rem;
        }

        .password-requirements li {
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .password-requirements li i {
            font-size: 0.75rem;
        }

        .password-requirements li.valid {
            color: #059669;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .register-container {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1>Create Account</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required autofocus placeholder="Enter your full name">
                <i class="fas fa-user"></i>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Create a password">
                <i class="fas fa-lock"></i>
                <div class="password-requirements">
                    <p>Password must contain:</p>
                    <ul>
                        <li id="length"><i class="fas fa-circle"></i> At least 8 characters</li>
                        <li id="uppercase"><i class="fas fa-circle"></i> One uppercase letter</li>
                        <li id="lowercase"><i class="fas fa-circle"></i> One lowercase letter</li>
                        <li id="number"><i class="fas fa-circle"></i> One number</li>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Confirm your password">
                <i class="fas fa-lock"></i>
            </div>
            <button type="submit" class="btn">Create Account</button>
        </form>
        <div class="text-center">
            <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
        </div>
    </div>

    <script>
        const password = document.getElementById('password');
        const requirements = {
            length: document.getElementById('length'),
            uppercase: document.getElementById('uppercase'),
            lowercase: document.getElementById('lowercase'),
            number: document.getElementById('number')
        };

        password.addEventListener('input', function() {
            const value = this.value;
            
            // Check length
            if (value.length >= 8) {
                requirements.length.classList.add('valid');
                requirements.length.querySelector('i').className = 'fas fa-check-circle';
            } else {
                requirements.length.classList.remove('valid');
                requirements.length.querySelector('i').className = 'fas fa-circle';
            }

            // Check uppercase
            if (/[A-Z]/.test(value)) {
                requirements.uppercase.classList.add('valid');
                requirements.uppercase.querySelector('i').className = 'fas fa-check-circle';
            } else {
                requirements.uppercase.classList.remove('valid');
                requirements.uppercase.querySelector('i').className = 'fas fa-circle';
            }

            // Check lowercase
            if (/[a-z]/.test(value)) {
                requirements.lowercase.classList.add('valid');
                requirements.lowercase.querySelector('i').className = 'fas fa-check-circle';
            } else {
                requirements.lowercase.classList.remove('valid');
                requirements.lowercase.querySelector('i').className = 'fas fa-circle';
            }

            // Check number
            if (/[0-9]/.test(value)) {
                requirements.number.classList.add('valid');
                requirements.number.querySelector('i').className = 'fas fa-check-circle';
            } else {
                requirements.number.classList.remove('valid');
                requirements.number.querySelector('i').className = 'fas fa-circle';
            }
        });
    </script>
</body>
</html>
