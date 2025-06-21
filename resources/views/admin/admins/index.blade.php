<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management - Admin Dashboard</title>
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
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 1rem 1.5rem; text-align: left; border-bottom: 1px solid var(--gray-200); }
        .table th { background: var(--gray-50); font-weight: 600; color: var(--gray-700); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .table td { color: var(--gray-900); }

        .add-btn {
            background: var(--success);
            color: var(--white);
            padding: 0.875rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
        }

        .add-btn:hover {
            background: #047857;
            transform: translateY(-2px);
        }

        .role-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .role-badge.super_admin {
            background: #fef3c7;
            color: #92400e;
        }

        .role-badge.admin {
            background: #dbeafe;
            color: var(--primary);
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
                <div class="nav-item">
                    <a href="{{ route('admin.admins') }}" class="nav-link active">
                        <i class="fas fa-user-shield"></i>
                        Admin Management
                    </a>
                </div>
            </nav>
        </aside>

        <main class="main-content">
            <div class="header">
                <h1>Admin Management</h1>
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

            @if(session('error'))
                <div style="background: #fef2f2; color: #991b1b; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; border: 1px solid #fecaca;">
                    {{ session('error') }}
                </div>
            @endif

            <div style="background: var(--white); border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); overflow: hidden;">
                <div style="background: var(--gray-50); padding: 1.5rem 2rem; border-bottom: 1px solid var(--gray-200); display: flex; justify-content: space-between; align-items: center;">
                    <h3 style="font-size: 1.25rem; font-weight: 600; color: var(--gray-900);">All Administrators</h3>
                    <a href="{{ route('admin.admins.create') }}" class="add-btn">
                        <i class="fas fa-plus"></i>
                        Add New Admin
                    </a>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($admins as $admin)
                        <tr>
                            <td>{{ $admin->id }}</td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--primary); color: var(--white); display: flex; align-items: center; justify-content: center; font-weight: 600;">
                                        {{ strtoupper(substr($admin->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 600;">{{ $admin->name }}</div>
                                        @if($admin->id === auth('admin')->id())
                                            <small style="color: var(--success);">(You)</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                <span class="role-badge {{ $admin->role }}">
                                    {{ $admin->role === 'super_admin' ? 'Super Admin' : 'Admin' }}
                                </span>
                            </td>
                            <td>{{ $admin->created_at ? $admin->created_at->format('M d, Y') : 'N/A' }}</td>
                            <td>
                                <div style="display: flex; gap: 0.5rem;">
                                    <a href="{{ route('admin.admins.edit', $admin) }}" style="background: var(--warning); color: var(--white); padding: 0.5rem 1rem; border-radius: 6px; text-decoration: none; font-size: 0.875rem;">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    @if($admin->id !== auth('admin')->id() &&
                                        !(($admin->role === 'super_admin') && (\App\Models\Admin::where('role', 'super_admin')->count() <= 1)))
                                        <button onclick="deleteAdmin({{ $admin->id }}, '{{ $admin->name }}')" style="background: var(--danger); color: var(--white); border: none; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer; font-size: 0.875rem;">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    @else
                                        <span style="background: var(--gray-200); color: var(--gray-700); padding: 0.5rem 1rem; border-radius: 6px; font-size: 0.875rem;">
                                            @if($admin->id === auth('admin')->id())
                                                <i class="fas fa-user"></i> Current User
                                            @else
                                                <i class="fas fa-shield-alt"></i> Protected
                                            @endif
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 2rem; color: var(--gray-700);">
                                No administrators found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div style="padding: 1rem 2rem;">
                    {{ $admins->links() }}
                </div>
            </div>
        </main>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 2000;">
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 2rem; border-radius: 12px; width: 90%; max-width: 400px;">
            <h3 style="margin-bottom: 1rem; color: var(--danger);">
                <i class="fas fa-exclamation-triangle"></i> Confirm Deletion
            </h3>
            <p style="margin-bottom: 1.5rem; color: var(--gray-700);">
                Are you sure you want to delete admin <strong id="adminName"></strong>? This action cannot be undone.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                <button onclick="closeDeleteModal()" style="background: var(--gray-200); color: var(--gray-700); border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer;">
                    Cancel
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background: var(--danger); color: var(--white); border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer;">
                        <i class="fas fa-trash"></i> Delete Admin
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function deleteAdmin(adminId, adminName) {
            document.getElementById('adminName').textContent = adminName;
            document.getElementById('deleteForm').action = `/admin/admins/${adminId}`;
            document.getElementById('deleteModal').style.display = 'block';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>
</body>
</html>
