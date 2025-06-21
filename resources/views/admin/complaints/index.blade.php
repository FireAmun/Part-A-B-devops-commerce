<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints - Admin Dashboard - UTM Commerce Connect</title>
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

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--white);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border-left: 4px solid var(--primary);
        }

        .stat-card.success {
            border-left-color: var(--success);
        }

        .stat-card.warning {
            border-left-color: var(--warning);
        }

        .stat-card.danger {
            border-left-color: var(--danger);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .stat-title {
            color: var(--gray-700);
            font-size: 1rem;
            font-weight: 600;
        }

        .stat-icon {
            color: var(--primary);
            font-size: 1.5rem;
        }

        .stat-icon.success {
            color: var(--success);
        }

        .stat-icon.warning {
            color: var(--warning);
        }

        .stat-icon.danger {
            color: var(--danger);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--gray-900);
        }

        .card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .card-header {
            background: var(--gray-50);
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--gray-900);
        }

        .card-body {
            padding: 2rem;
        }

        .tabs {
            display: flex;
            border-bottom: 1px solid var(--gray-200);
            margin-bottom: 2rem;
        }

        .tab {
            padding: 0.75rem 1.5rem;
            color: var(--gray-700);
            font-weight: 500;
            cursor: pointer;
            border-bottom: 3px solid transparent;
        }

        .tab.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        .accordion-item {
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            margin-bottom: 1rem;
            overflow: hidden;
        }

        .accordion-header {
            background: var(--gray-50);
            padding: 1.25rem 2rem;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .accordion-title {
            font-weight: 600;
            color: var(--gray-900);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .accordion-body {
            padding: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .accordion-body.active {
            max-height: 5000px;
            padding: 1.5rem 2rem;
        }

        .complaints-table {
            width: 100%;
            border-collapse: collapse;
        }

        .complaints-table th,
        .complaints-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--gray-200);
            vertical-align: top;
        }

        .complaints-table th {
            font-weight: 600;
            color: var(--gray-700);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: var(--gray-50);
        }

        .complaints-table tr:last-child td {
            border-bottom: none;
        }

        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
        }

        .badge-success {
            background: #dcfce7;
            color: var(--success);
        }

        .badge-warning {
            background: #fef3c7;
            color: var(--warning);
        }

        .badge-danger {
            background: #fee2e2;
            color: var(--danger);
        }

        .badge-primary {
            background: #dbeafe;
            color: var(--primary);
        }

        .response-form {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--gray-200);
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--gray-700);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            font-family: inherit;
            font-size: 1rem;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            font-family: inherit;
            font-size: 1rem;
            appearance: none;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23374151' viewBox='0 0 16 16'%3E%3Cpath d='M8 12l-6-6 1.41-1.41L8 9.17l4.59-4.58L14 6l-6 6z'/%3E%3C/svg%3E") no-repeat right 1rem center;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-primary {
            background: var(--primary);
            color: var(--white);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-secondary {
            background: var(--gray-100);
            color: var(--gray-900);
        }

        .btn-secondary:hover {
            background: var(--gray-200);
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .alert-success {
            background: #dcfce7;
            color: var(--success);
        }

        .alert-danger {
            background: #fee2e2;
            color: var(--danger);
        }

        .complaint-details {
            margin-bottom: 1rem;
        }

        .detail-row {
            display: flex;
            margin-bottom: 0.5rem;
        }

        .detail-label {
            font-weight: 600;
            width: 150px;
        }

        .toggle-icon {
            transition: transform 0.3s;
        }

        .rotate-icon {
            transform: rotate(180deg);
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

            .stats-grid {
                grid-template-columns: 1fr;
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
                    <a href="{{ route('admin.complaints') }}" class="nav-link active">
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
                @if(session('admin_role') === 'super_admin')
                <div class="nav-item">
                    <a href="{{ route('admin.admins') }}" class="nav-link">
                        <i class="fas fa-user-shield"></i>
                        Admin Management
                    </a>
                </div>
                @endif
            </nav>
        </aside>

        <main class="main-content">
            <div class="header">
                <h1>Complaints Management</h1>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Total Complaints</div>
                        <div class="stat-icon">
                            <i class="fas fa-comment-alt"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ number_format($stats['total']) }}</div>
                </div>

                <div class="stat-card warning">
                    <div class="stat-header">
                        <div class="stat-title">Open Complaints</div>
                        <div class="stat-icon warning">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ number_format($stats['open']) }}</div>
                </div>

                <div class="stat-card success">
                    <div class="stat-header">
                        <div class="stat-title">Resolved</div>
                        <div class="stat-icon success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ number_format($stats['resolved']) }}</div>
                </div>

                <div class="stat-card danger">
                    <div class="stat-header">
                        <div class="stat-title">General Complaints</div>
                        <div class="stat-icon danger">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ number_format($stats['general_count']) }}</div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">General Complaints</h2>
                </div>
                <div class="card-body">
                    @if(count($groupedComplaints['general']) > 0)
                        <table class="complaints-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>User</th>
                                    <th>Subject</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($groupedComplaints['general'] as $complaint)
                                <tr>
                                    <td>{{ $complaint->created_at->format('M d, Y') }}</td>
                                    <td>
                                        {{ $complaint->user_name }}<br>
                                        <small>{{ $complaint->user_email }}</small>
                                    </td>
                                    <td>{{ $complaint->subject }}</td>
                                    <td>
                                        @if($complaint->priority == 'high')
                                            <span class="badge badge-danger">High</span>
                                        @elseif($complaint->priority == 'medium')
                                            <span class="badge badge-warning">Medium</span>
                                        @else
                                            <span class="badge badge-primary">Low</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($complaint->status == 'open')
                                            <span class="badge badge-danger">Open</span>
                                        @elseif($complaint->status == 'processing')
                                            <span class="badge badge-warning">Processing</span>
                                        @else
                                            <span class="badge badge-success">Resolved</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-secondary btn-sm toggle-complaint" data-complaint-id="{{ $complaint->id }}">
                                            <i class="fas fa-chevron-down"></i> Details
                                        </button>
                                    </td>
                                </tr>
                                <tr class="complaint-details-row" id="complaint-details-{{ $complaint->id }}" style="display: none;">
                                    <td colspan="6">
                                        <div class="complaint-details">
                                            <div class="detail-row">
                                                <div class="detail-label">Description:</div>
                                                <div class="detail-value">{{ $complaint->description }}</div>
                                            </div>

                                            @if($complaint->admin_response)
                                            <div class="detail-row">
                                                <div class="detail-label">Admin Response:</div>
                                                <div class="detail-value">{{ $complaint->admin_response }}</div>
                                            </div>
                                            @endif
                                        </div>

                                        <div class="response-form">
                                            <form action="{{ route('admin.complaints.update', $complaint->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label class="form-label" for="status-{{ $complaint->id }}">Update Status</label>
                                                    <select class="form-select" id="status-{{ $complaint->id }}" name="status">
                                                        <option value="open" {{ $complaint->status == 'open' ? 'selected' : '' }}>Open</option>
                                                        <option value="processing" {{ $complaint->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                                        <option value="resolved" {{ $complaint->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="admin_response-{{ $complaint->id }}">Admin Response</label>
                                                    <textarea class="form-control" id="admin_response-{{ $complaint->id }}" name="admin_response" rows="3">{{ $complaint->admin_response }}</textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Update Complaint</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No general complaints found.</p>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Vendor Complaints</h2>
                </div>
                <div class="card-body">
                    @if(count($groupedComplaints['vendors']) > 0)
                        @foreach($groupedComplaints['vendors'] as $vendorId => $vendorData)
                            <div class="accordion-item">
                                <div class="accordion-header" onclick="toggleAccordion('vendor-{{ $vendorId }}')">
                                    <div class="accordion-title">
                                        <i class="fas fa-store"></i>
                                        {{ $vendorData['vendor']->name }}
                                        <span class="badge badge-primary" style="margin-left: 10px;">
                                            {{ count($vendorData['complaints']) }} complaints
                                        </span>
                                    </div>
                                    <i class="fas fa-chevron-down toggle-icon" id="vendor-{{ $vendorId }}-icon"></i>
                                </div>
                                <div class="accordion-body" id="vendor-{{ $vendorId }}-content">
                                    <table class="complaints-table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>User</th>
                                                <th>Subject</th>
                                                <th>Priority</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($vendorData['complaints'] as $complaint)
                                            <tr>
                                                <td>{{ $complaint->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    {{ $complaint->user_name }}<br>
                                                    <small>{{ $complaint->user_email }}</small>
                                                </td>
                                                <td>{{ $complaint->subject }}</td>
                                                <td>
                                                    @if($complaint->priority == 'high')
                                                        <span class="badge badge-danger">High</span>
                                                    @elseif($complaint->priority == 'medium')
                                                        <span class="badge badge-warning">Medium</span>
                                                    @else
                                                        <span class="badge badge-primary">Low</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($complaint->status == 'open')
                                                        <span class="badge badge-danger">Open</span>
                                                    @elseif($complaint->status == 'processing')
                                                        <span class="badge badge-warning">Processing</span>
                                                    @else
                                                        <span class="badge badge-success">Resolved</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-secondary btn-sm toggle-complaint" data-complaint-id="{{ $complaint->id }}">
                                                        <i class="fas fa-chevron-down"></i> Details
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr class="complaint-details-row" id="complaint-details-{{ $complaint->id }}" style="display: none;">
                                                <td colspan="6">
                                                    <div class="complaint-details">
                                                        <div class="detail-row">
                                                            <div class="detail-label">Description:</div>
                                                            <div class="detail-value">{{ $complaint->description }}</div>
                                                        </div>

                                                        @if($complaint->admin_response)
                                                        <div class="detail-row">
                                                            <div class="detail-label">Admin Response:</div>
                                                            <div class="detail-value">{{ $complaint->admin_response }}</div>
                                                        </div>
                                                        @endif
                                                    </div>

                                                    <div class="response-form">
                                                        <form action="{{ route('admin.complaints.update', $complaint->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label class="form-label" for="status-{{ $complaint->id }}">Update Status</label>
                                                                <select class="form-select" id="status-{{ $complaint->id }}" name="status">
                                                                    <option value="open" {{ $complaint->status == 'open' ? 'selected' : '' }}>Open</option>
                                                                    <option value="processing" {{ $complaint->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                                                    <option value="resolved" {{ $complaint->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="admin_response-{{ $complaint->id }}">Admin Response</label>
                                                                <textarea class="form-control" id="admin_response-{{ $complaint->id }}" name="admin_response" rows="3">{{ $complaint->admin_response }}</textarea>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Update Complaint</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No vendor complaints found.</p>
                    @endif
                </div>
            </div>

        </main>
    </div>

    <script>
        // Toggle accordion content
        function toggleAccordion(id) {
            const content = document.getElementById(`${id}-content`);
            const icon = document.getElementById(`${id}-icon`);

            content.classList.toggle('active');
            icon.classList.toggle('rotate-icon');
        }

        // Toggle complaint details
        document.querySelectorAll('.toggle-complaint').forEach(button => {
            button.addEventListener('click', function() {
                const complaintId = this.getAttribute('data-complaint-id');
                const detailsRow = document.getElementById(`complaint-details-${complaintId}`);

                if (detailsRow.style.display === 'none') {
                    detailsRow.style.display = 'table-row';
                    this.innerHTML = '<i class="fas fa-chevron-up"></i> Hide Details';
                } else {
                    detailsRow.style.display = 'none';
                    this.innerHTML = '<i class="fas fa-chevron-down"></i> Details';
                }
            });
        });
    </script>
</body>
</html>
