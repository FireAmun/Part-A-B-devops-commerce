<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | UTM Commerce Connect</title>
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
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 2rem;
        }

        .reset-password-container {
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

        h1 {
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

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text);
            font-size: 0.95rem;
        }

        input {
            width: 100%;
            padding: 1rem;
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            font-size: 1rem;
            transition: var(--transition);
            background: var(--gray-100);
        }

        input:focus {
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
            cursor: pointer;
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
            color: var(--success);
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .reset-password-container {
                padding: 2rem 1.5rem;
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
    <div class="reset-password-container">
        <h1>Reset Password</h1>

        @if (session('status'))
            <div class="notification notification-success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="notification notification-error">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="email" value="{{ request('email') }}">

            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter your new password">
                <i class="fas fa-eye-slash toggle-password"></i>
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
                <label for="password_confirmation">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Confirm your new password">
                <i class="fas fa-eye-slash toggle-password"></i>
            </div>

            <button type="submit" class="btn">
                <i class="fas fa-key"></i> Reset Password
            </button>
        </form>

        <div class="text-center">
            <p><a href="{{ route('login') }}"><i class="fas fa-arrow-left"></i> Back to Login</a></p>
        </div>
    </div>

    <script>
        // Password visibility toggle
        document.querySelectorAll('.toggle-password').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });

        // Password validation
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
