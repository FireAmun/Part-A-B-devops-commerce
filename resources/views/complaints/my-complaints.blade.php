<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Complaints - UTM Commerce Connect</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #1e3a8a;
            --primary-light: #2563eb;
            --success: #059669;
            --danger: #dc2626;
            --warning: #f59e0b;
            --text: #1f2937;
            --text-light: #6b7280;
            --white: #ffffff;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, var(--gray-100), var(--white));
            margin: 0;
            padding: 0;
            color: var(--text);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            background: var(--white);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 2.5rem;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            background: var(--gray-200);
            color: var(--primary);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .back-btn:hover {
            background: var(--primary);
            color: var(--white);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            color: var(--primary);
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .new-complaint-btn {
            background: var(--primary);
            color: var(--white);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .new-complaint-btn:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
        }

        .complaints-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 2rem;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .complaints-table th,
        .complaints-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--gray-200);
        }

        .complaints-table th {
            background: var(--gray-100);
            font-weight: 600;
            color: var(--text);
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .complaints-table tr:last-child td {
            border-bottom: none;
        }

        .complaints-table tr:hover {
            background: var(--gray-100);
        }

        .status {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
        }

        .status.pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status.in_progress {
            background: #dbeafe;
            color: #1e40af;
        }

        .status.resolved {
            background: #dcfce7;
            color: #166534;
        }

        .status.closed {
            background: #fee2e2;
            color: #991b1b;
        }

        .priority {
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
        }

        .priority.low {
            background: #dcfce7;
            color: #166534;
        }

        .priority.medium {
            background: #fef3c7;
            color: #92400e;
        }

        .priority.high {
            background: #fee2e2;
            color: #991b1b;
        }

        .vendor-badge {
            background: var(--primary);
            color: var(--white);
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .complaint-subject {
            font-weight: 600;
            color: var(--text);
            margin-bottom: 0.25rem;
        }

        .complaint-description {
            color: var(--text-light);
            font-size: 0.9rem;
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .date {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .no-complaints {
            text-align: center;
            color: var(--text-light);
            padding: 4rem 0;
            background: var(--gray-100);
            border-radius: 12px;
            margin: 2rem 0;
        }

        .no-complaints i {
            font-size: 3rem;
            color: var(--gray-300);
            margin-bottom: 1rem;
        }

        .no-complaints p {
            font-size: 1.1rem;
            margin: 0 0 1.5rem 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
        }

        .stat-card h3 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-card h3.pending { color: var(--warning); }
        .stat-card h3.resolved { color: var(--success); }
        .stat-card h3.total { color: var(--primary); }

        .stat-card p {
            color: var(--text-light);
            font-size: 0.9rem;
            margin: 0;
        }

        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 1.5rem;
            }

            .header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .complaints-table {
                font-size: 0.85rem;
            }

            .complaints-table th,
            .complaints-table td {
                padding: 0.75rem 0.5rem;
            }

            .complaint-description {
                max-width: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('complaints.index') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Back to Submit Complaint
        </a>

        <div class="header">
            <h1>
                <i class="fas fa-list"></i>
                My Complaints
            </h1>
            <a href="{{ route('complaints.index') }}" class="new-complaint-btn">
                <i class="fas fa-plus"></i>
                New Complaint
            </a>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3 class="total">{{ $complaints->count() }}</h3>
                <p>Total Complaints</p>
            </div>
            <div class="stat-card">
                <h3 class="pending">{{ $complaints->where('status', 'pending')->count() }}</h3>
                <p>Pending</p>
            </div>
            <div class="stat-card">
                <h3 class="resolved">{{ $complaints->where('status', 'resolved')->count() }}</h3>
                <p>Resolved</p>
            </div>
        </div>

        @if($complaints->count() > 0)
            <table class="complaints-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Subject & Description</th>
                        <th>Type</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Submitted</th>
                        <th>Response</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($complaints as $complaint)
                        <tr>
                            <td>{{ $complaint->id }}</td>
                            <td>
                                <div class="complaint-subject">{{ $complaint->subject }}</div>
                                <div class="complaint-description" title="{{ $complaint->description }}">
                                    {{ Str::limit($complaint->description, 80) }}
                                </div>
                            </td>
                            <td>
                                @if($complaint->complaint_type == 'vendor_specific')
                                    <div class="vendor-badge">
                                        @php
                                            $vendorNames = [
                                                0 => 'UTM Mart',
                                                1 => 'UTM Mart',
                                                2 => 'Setepak Printing',
                                                3 => 'Richiamo Caffe'
                                            ];
                                        @endphp
                                        {{ $vendorNames[$complaint->vendor_id] ?? 'Unknown Vendor' }}
                                    </div>
                                @else
                                    <span style="color: var(--text-light);">General</span>
                                @endif
                            </td>
                            <td>
                                <span class="priority {{ $complaint->priority }}">
                                    {{ ucfirst($complaint->priority) }}
                                </span>
                            </td>
                            <td>
                                <span class="status {{ $complaint->status }}">
                                    {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                                </span>
                            </td>
                            <td class="date">
                                {{ $complaint->created_at->format('M d, Y') }}
                                <br>
                                <small>{{ $complaint->created_at->format('h:i A') }}</small>
                            </td>
                            <td>
                                @if($complaint->admin_response)
                                    <div style="max-width: 200px; font-size: 0.9rem; color: var(--text-light);">
                                        {{ Str::limit($complaint->admin_response, 60) }}
                                    </div>
                                    @if($complaint->status == 'resolved')
                                        <small class="date">
                                            Resolved: {{ $complaint->updated_at->format('M d, Y') }}
                                        </small>
                                    @endif
                                @else
                                    <span style="color: var(--text-light); font-style: italic;">
                                        No response yet
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-complaints">
                <i class="fas fa-inbox"></i>
                <p>No complaints found for your email address.</p>
                <a href="{{ route('complaints.index') }}" class="new-complaint-btn">
                    <i class="fas fa-plus"></i>
                    Submit Your First Complaint
                </a>
            </div>
        @endif
    </div>
</body>
</html>
