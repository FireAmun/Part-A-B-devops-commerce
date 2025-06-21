<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Management - Admin Dashboard</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --secondary: #3b82f6;
            --success: #059669;
            --warning: #f59e0b;
            --danger: #dc2626;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-700: #374151;
            --gray-900: #111827;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: var(--gray-50);
            color: var(--gray-900);
            line-height: 1.6;
        }

        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: var(--white);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            text-align: center;
        }

        .sidebar-header h2 {
            color: var(--primary);
            font-size: 1.5rem;
            font-weight: 600;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-item {
            margin: 0.25rem 1rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            color: var(--gray-700);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s;
            font-weight: 500;
        }

        .nav-link:hover, .nav-link.active {
            background: var(--primary);
            color: var(--white);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
        }

        .main-content {
            margin-left: 280px;
            flex: 1;
            padding: 2rem;
        }

        .header {
            background: var(--white);
            padding: 1.5rem 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            color: var(--gray-900);
            font-size: 2rem;
            font-weight: 600;
        }

        .logout-btn {
            background: var(--danger);
            color: var(--white);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
        }

        .logout-btn:hover {
            background: #b91c1c;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 1rem 2rem;
            text-align: left;
            border-bottom: 1px solid var(--gray-200);
        }

        .table th {
            background: var(--gray-50);
            font-weight: 600;
            color: var(--gray-700);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table td {
            color: var(--gray-900);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-warning {
            background: var(--warning);
            color: var(--white);
        }

        .btn-warning:hover {
            background: #d97706;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .header {
                padding: 1rem;
            }

            .header h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-shield-alt"></i> Admin Panel</h2>
            </div>
            <nav class="sidebar-nav">
                <div class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.users') }}" class="nav-link">
                        <i class="fas fa-users"></i>
                        User Management
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.vendors') }}" class="nav-link active">
                        <i class="fas fa-store"></i>
                        Vendor Management
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.products') }}" class="nav-link">
                        <i class="fas fa-box"></i>
                        Product Management
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.complaints') }}" class="nav-link">
                        <i class="fas fa-comment-alt"></i>
                        Complaints
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.analytics') }}" class="nav-link">
                        <i class="fas fa-chart-line"></i>
                        Analytics & Reports
                    </a>
                </div>
            </nav>
        </aside>

        <main class="main-content">
            <div class="header">
                <h1>Vendor Management</h1>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>

            @if(session('success'))
                <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; border: 1px solid #bbf7d0;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="background: var(--white); border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); overflow: hidden;">
                <div style="background: var(--gray-50); padding: 1.5rem 2rem; border-bottom: 1px solid var(--gray-200);">
                    <h3 style="font-size: 1.25rem; font-weight: 600; color: var(--gray-900);">All Vendors</h3>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Vendor Name</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vendors as $vendor)
                        <tr>
                            <td>{{ $vendor->id }}</td>
                            <td>{{ $vendor->name }}</td>
                            <td>
                                @if($vendor->name == 'utmmart2@gmail.com')
                                    UTM Mart
                                @elseif($vendor->name == 'setepakprintingservicektf@gmail.com')
                                    Setepak Printing Service KTF
                                @elseif($vendor->name == 'richiamocaffe@gmail.com')
                                    Richiamo Caffe
                                @else
                                    {{ $vendor->name }}
                                @endif
                            </td>
                            <td>{{ $vendor->created_at ? $vendor->created_at->format('M d, Y') : 'N/A' }}</td>
                            <td>
                                <button onclick="resetVendorPassword('{{ $vendor->name }}')" class="btn btn-warning">
                                    <i class="fas fa-key"></i> Reset Password
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 2rem; color: var(--gray-700);">
                                No vendors found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Password Reset Modal -->
    <div id="passwordModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 2000;">
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 2rem; border-radius: 12px; width: 90%; max-width: 500px;">
            <h3 style="margin-bottom: 1.5rem; color: var(--gray-900);">Reset Vendor Password</h3>

            <div id="step1">
                <p style="margin-bottom: 1rem; color: var(--gray-700);">Send OTP to vendor email for verification:</p>
                <p id="vendorEmail" style="font-weight: 600; margin-bottom: 1rem;"></p>
                <button onclick="sendOTP()" id="sendOtpBtn" style="background: var(--primary); color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer;">
                    Send OTP
                </button>
            </div>

            <div id="step2" style="display: none;">
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">OTP Code:</label>
                    <input type="text" id="otpCode" placeholder="Enter 6-digit OTP" maxlength="6" style="width: 100%; padding: 0.75rem; border: 1px solid var(--gray-200); border-radius: 8px;">
                </div>
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">New Password:</label>
                    <input type="password" id="newPassword" placeholder="Enter new password" style="width: 100%; padding: 0.75rem; border: 1px solid var(--gray-200); border-radius: 8px;">
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Confirm Password:</label>
                    <input type="password" id="confirmPassword" placeholder="Confirm new password" style="width: 100%; padding: 0.75rem; border: 1px solid var(--gray-200); border-radius: 8px;">
                </div>
                <button onclick="resetPassword()" id="resetBtn" style="background: var(--success); color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; margin-right: 1rem;">
                    Reset Password
                </button>
            </div>

            <button onclick="closeModal()" style="background: var(--gray-200); color: var(--gray-700); border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer;">
                Cancel
            </button>

            <div id="message" style="margin-top: 1rem; padding: 0.75rem; border-radius: 8px; display: none;"></div>
        </div>
    </div>

    <script>
        let currentVendorEmail = '';

        function resetVendorPassword(email) {
            currentVendorEmail = email;
            document.getElementById('vendorEmail').textContent = email;
            document.getElementById('passwordModal').style.display = 'block';
            document.getElementById('step1').style.display = 'block';
            document.getElementById('step2').style.display = 'none';
        }

        function closeModal() {
            document.getElementById('passwordModal').style.display = 'none';
            document.getElementById('step1').style.display = 'block';
            document.getElementById('step2').style.display = 'none';
            document.getElementById('message').style.display = 'none';
            // Clear form
            document.getElementById('otpCode').value = '';
            document.getElementById('newPassword').value = '';
            document.getElementById('confirmPassword').value = '';
        }

        function sendOTP() {
            const btn = document.getElementById('sendOtpBtn');
            btn.textContent = 'Sending...';
            btn.disabled = true;

            fetch('{{ route('admin.vendors.sendOtp') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email: currentVendorEmail })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('step1').style.display = 'none';
                    document.getElementById('step2').style.display = 'block';
                    showMessage(data.message, 'success');
                } else {
                    showMessage(data.message, 'error');
                }
            })
            .catch(error => {
                showMessage('Failed to send OTP', 'error');
            })
            .finally(() => {
                btn.textContent = 'Send OTP';
                btn.disabled = false;
            });
        }

        function resetPassword() {
            const otp = document.getElementById('otpCode').value;
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (!otp || otp.length !== 6) {
                showMessage('Please enter a valid 6-digit OTP', 'error');
                return;
            }

            if (newPassword !== confirmPassword) {
                showMessage('Passwords do not match', 'error');
                return;
            }

            if (newPassword.length < 8) {
                showMessage('Password must be at least 8 characters', 'error');
                return;
            }

            const btn = document.getElementById('resetBtn');
            btn.textContent = 'Resetting...';
            btn.disabled = true;

            fetch('{{ route('admin.vendors.resetPassword') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    email: currentVendorEmail,
                    otp: otp,
                    new_password: newPassword,
                    new_password_confirmation: confirmPassword
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showMessage(data.message, 'success');
                    setTimeout(() => closeModal(), 2000);
                } else {
                    showMessage(data.message, 'error');
                }
            })
            .catch(error => {
                showMessage('Failed to reset password', 'error');
            })
            .finally(() => {
                btn.textContent = 'Reset Password';
                btn.disabled = false;
            });
        }

        function showMessage(message, type) {
            const messageDiv = document.getElementById('message');
            messageDiv.textContent = message;
            messageDiv.style.display = 'block';
            messageDiv.style.background = type === 'success' ? '#dcfce7' : '#fef2f2';
            messageDiv.style.color = type === 'success' ? '#166534' : '#991b1b';
            messageDiv.style.border = type === 'success' ? '1px solid #bbf7d0' : '1px solid #fecaca';
        }
    </script>
</body>
</html>
