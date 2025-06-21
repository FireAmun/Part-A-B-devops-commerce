<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password | UTM Commerce Connect</title>
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

        .container {
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

        #otp-section {
            display: none;
            animation: fadeIn 0.3s ease-in-out;
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

            .container {
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
    <div class="container">
        <h1>Reset Password</h1>

        <!-- Email Form -->
        <form id="email-form" method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required autofocus placeholder="Enter your email address" />
                <i class="fas fa-envelope"></i>
            </div>
            <button type="submit" class="btn">
                <i class="fas fa-paper-plane"></i> Send Reset Link
            </button>
        </form>

        <!-- OTP Section -->
        <form id="otp-section" method="POST" action="{{ route('otp.verify') }}" style="display: none;">
            @csrf
            <div class="form-group">
                <label for="otp">Verification Code</label>
                <input type="text" id="otp" name="otp" required placeholder="Enter the code sent to your email" />
                <i class="fas fa-key"></i>
            </div>
            <div class="form-group">
                <label for="otp-email">Email Address</label>
                <input type="email" id="otp-email" name="email" required readonly />
                <i class="fas fa-envelope"></i>
            </div>
            <button type="submit" class="btn">
                <i class="fas fa-check"></i> Verify Code
            </button>
        </form>

        <div class="text-center">
            <p><a href="{{ route('login') }}"><i class="fas fa-arrow-left"></i> Back to Login</a></p>
        </div>
    </div>

    <div id="notification-container"></div>

    <script>
        document.getElementById('email-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const emailValue = document.getElementById('email').value;

            if (!emailValue) {
                showNotification('Please enter your email address.', 'error');
                return;
            }

            fetch(this.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({ email: emailValue })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    showNotification(data.status, 'success');
                    document.getElementById('otp-email').value = emailValue;
                    document.getElementById('email-form').style.display = 'none';
                    document.getElementById('otp-section').style.display = 'block';
                } else if (data.errors) {
                    showNotification(data.errors.email || 'An error occurred. Please try again.', 'error');
                }
            })
            .catch(error => {
                showNotification('Failed to send reset link. Please try again later.', 'error');
                console.error('Error:', error);
            });
        });

        function showNotification(message, type) {
            const container = document.getElementById('notification-container');
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            
            const icon = type === 'success' ? 'check-circle' : 'exclamation-circle';
            notification.innerHTML = `
                <i class="fas fa-${icon}"></i>
                <span>${message}</span>
            `;
            
            container.appendChild(notification);

            setTimeout(() => {
                notification.classList.add('hide');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 4000);
        }
    </script>
</body>
</html>
