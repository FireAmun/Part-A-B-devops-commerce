<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Admin Dashboard</title>
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

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: var(--gray-50); color: var(--gray-900); line-height: 1.6; }
        .admin-layout { display: flex; min-height: 100vh; }
        .sidebar { width: 280px; background: var(--white); box-shadow: 2px 0 10px rgba(0,0,0,0.1); position: fixed; height: 100vh; overflow-y: auto; z-index: 1000; }
        .sidebar-header { padding: 2rem 1.5rem; border-bottom: 1px solid var(--gray-200); text-align: center; }
        .sidebar-header h2 { color: var(--primary); font-size: 1.5rem; font-weight: 600; }
        .sidebar-nav { padding: 1rem 0; }
        .nav-item { margin: 0.25rem 1rem; }
        .nav-link { display: flex; align-items: center; gap: 0.75rem; padding: 0.875rem 1rem; color: var(--gray-700); text-decoration: none; border-radius: 8px; transition: all 0.2s; font-weight: 500; }
        .nav-link:hover, .nav-link.active { background: var(--primary); color: var(--white); }
        .nav-link i { width: 20px; text-align: center; }
        .main-content { margin-left: 280px; flex: 1; padding: 2rem; }
        .header { background: var(--white); padding: 1.5rem 2rem; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { color: var(--gray-900); font-size: 2rem; font-weight: 600; }
        .logout-btn { background: var(--danger); color: var(--white); border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 500; transition: all 0.2s; }
        .logout-btn:hover { background: #b91c1c; }

        .form-container {
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            padding: 2rem;
            max-width: 600px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--gray-700);
        }

        .form-group input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid var(--gray-200);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s;
            background: var(--gray-50);
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.875rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--primary);
            color: var(--white);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-secondary {
            background: var(--gray-200);
            color: var(--gray-700);
        }

        .btn-secondary:hover {
            background: var(--gray-300);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            background: var(--gray-100);
            color: var(--primary-dark);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.25rem;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
            text-decoration: none;
        }

        .back-btn:hover {
            background: var(--gray-200);
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .optional-section {
            border-top: 1px solid var(--gray-200);
            padding-top: 1.5rem;
            margin-top: 1.5rem;
        }

        .optional-title {
            color: var(--gray-700);
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; padding: 1rem; }
            .form-container { padding: 1.5rem; }
            .btn-group { flex-direction: column; }
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
                    <a href="{{ route('admin.users') }}" class="nav-link active">
                        <i class="fas fa-users"></i>
                        User Management
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.vendors') }}" class="nav-link">
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
                <h1>Edit User</h1>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>

            <div class="form-container">
                <a href="{{ route('admin.users') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    Back to Users
                </a>

                @if ($errors->any())
                    <div class="alert alert-error">
                        <strong>Please fix the following errors:</strong>
                        <ul style="margin: 0.5rem 0 0 1.5rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">
                            <i class="fas fa-user"></i> Full Name
                        </label>
                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name', $user->name) }}"
                               required
                               placeholder="Enter user's full name">
                    </div>

                    <div class="form-group">
                        <label for="email">
                            <i class="fas fa-envelope"></i> Email Address
                        </label>
                        <input type="email"
                               id="email"
                               name="email"
                               value="{{ old('email', $user->email) }}"
                               required
                               placeholder="Enter user's email address">
                    </div>

                    <div class="optional-section">
                        <div class="optional-title">
                            <i class="fas fa-key"></i> Change Password (Optional)
                        </div>
                        <p style="color: var(--gray-700); margin-bottom: 1rem; font-size: 0.9rem;">
                            Leave these fields empty if you don't want to change the password.
                        </p>

                        <div class="form-group">
                            <label for="password">
                                <i class="fas fa-lock"></i> New Password
                            </label>
                            <input type="password"
                                   id="password"
                                   name="password"
                                   placeholder="Enter new password (minimum 8 characters)">
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">
                                <i class="fas fa-lock"></i> Confirm New Password
                            </label>
                            <input type="password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   placeholder="Confirm the new password">
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Update User
                        </button>
                        <a href="{{ route('admin.users') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i>
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
