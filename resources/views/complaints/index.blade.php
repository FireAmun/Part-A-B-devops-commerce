<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Complaint - UTM Commerce Connect</title>
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
            max-width: 800px;
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
            text-align: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            color: var(--primary);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .header p {
            color: var(--text-light);
            font-size: 1.1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid var(--gray-200);
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
            background: var(--gray-100);
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .vendor-selection {
            display: none;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                max-height: 0;
            }
            to {
                opacity: 1;
                max-height: 200px;
            }
        }

        .priority-options {
            display: flex;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .priority-option {
            flex: 1;
            text-align: center;
        }

        .priority-option input[type="radio"] {
            display: none;
        }

        .priority-option label {
            display: block;
            padding: 0.75rem;
            border: 2px solid var(--gray-200);
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
        }

        .priority-option.low label {
            border-color: var(--success);
            color: var(--success);
        }

        .priority-option.medium label {
            border-color: var(--warning);
            color: var(--warning);
        }

        .priority-option.high label {
            border-color: var(--danger);
            color: var(--danger);
        }

        .priority-option input[type="radio"]:checked + label {
            background: var(--primary);
            color: var(--white);
            border-color: var(--primary);
        }

        .submit-btn {
            width: 100%;
            background: var(--primary);
            color: var(--white);
            border: none;
            padding: 1.25rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .submit-btn:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .success-message {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .my-complaints-link {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--gray-200);
        }

        .my-complaints-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
        }

        .my-complaints-link a:hover {
            color: var(--primary-light);
        }

        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 1.5rem;
            }

            .priority-options {
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('home') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Back to Home
        </a>

        <div class="header">
            <h1>
                <i class="fas fa-exclamation-triangle"></i>
                Submit Complaint
            </h1>
            <p>We value your feedback and will address your concerns promptly</p>
        </div>

        @if(session('success'))
            <div class="success-message">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(!auth()->check())
            <div style="background: #fee2e2; border: 1px solid #fecaca; color: #991b1b; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; text-align: center;">
                <i class="fas fa-exclamation-triangle"></i>
                Please <a href="{{ route('login') }}" style="color: #991b1b; font-weight: 600;">login</a> to submit a complaint.
            </div>
        @else
            <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                <strong>Submitting as:</strong> {{ auth()->user()->name }} ({{ auth()->user()->email }})
            </div>
        @endif

        <form method="POST" action="{{ route('complaints.store') }}">
            @csrf

            <div class="form-group">
                <label for="complaint_type">Complaint Type *</label>
                <select id="complaint_type" name="complaint_type" required onchange="toggleVendorSelection()">
                    <option value="">Select complaint type</option>
                    <option value="general" {{ old('complaint_type') == 'general' ? 'selected' : '' }}>General Complaint</option>
                    <option value="vendor_specific" {{ old('complaint_type') == 'vendor_specific' ? 'selected' : '' }}>Vendor Specific Complaint</option>
                </select>
                @error('complaint_type')
                    <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group vendor-selection" id="vendor-selection">
                <label for="vendor_id">Select Vendor *</label>
                <select id="vendor_id" name="vendor_id">
                    <option value="">Choose vendor</option>
                    <option value="0" {{ old('vendor_id') == '0' ? 'selected' : '' }}>UTM Mart</option>
                    <option value="2" {{ old('vendor_id') == '2' ? 'selected' : '' }}>Setepak Printing Service KTF</option>
                    <option value="3" {{ old('vendor_id') == '3' ? 'selected' : '' }}>Richiamo Caffe</option>
                </select>
            </div>

            <div class="form-group">
                <label for="subject">Subject *</label>
                <input type="text" id="subject" name="subject" required placeholder="Brief description of your complaint" value="{{ old('subject') }}">
                @error('subject')
                    <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Detailed Description *</label>
                <textarea id="description" name="description" required placeholder="Please provide a detailed description of your complaint...">{{ old('description') }}</textarea>
                @error('description')
                    <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Priority Level *</label>
                <div class="priority-options">
                    <div class="priority-option low">
                        <input type="radio" id="priority_low" name="priority" value="low" {{ old('priority') == 'low' ? 'checked' : '' }}>
                        <label for="priority_low">
                            <i class="fas fa-circle" style="color: #059669;"></i><br>
                            Low
                        </label>
                    </div>
                    <div class="priority-option medium">
                        <input type="radio" id="priority_medium" name="priority" value="medium" {{ old('priority', 'medium') == 'medium' ? 'checked' : '' }}>
                        <label for="priority_medium">
                            <i class="fas fa-circle" style="color: #f59e0b;"></i><br>
                            Medium
                        </label>
                    </div>
                    <div class="priority-option high">
                        <input type="radio" id="priority_high" name="priority" value="high" {{ old('priority') == 'high' ? 'checked' : '' }}>
                        <label for="priority_high">
                            <i class="fas fa-circle" style="color: #dc2626;"></i><br>
                            High
                        </label>
                    </div>
                </div>
                @error('priority')
                    <span style="color: var(--danger); font-size: 0.875rem;">{{ $message }}</span>
                @enderror
            </div>

            @if(auth()->check())
                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i>
                    Submit Complaint
                </button>
            @else
                <a href="{{ route('login') }}" class="submit-btn" style="text-decoration: none; text-align: center;">
                    <i class="fas fa-sign-in-alt"></i>
                    Login to Submit Complaint
                </a>
            @endif
        </form>

        <div class="my-complaints-link">
            <a href="{{ route('complaints.my') }}">
                <i class="fas fa-list"></i>
                View My Previous Complaints
            </a>
        </div>
    </div>

    <script>
        function toggleVendorSelection() {
            const complaintType = document.getElementById('complaint_type').value;
            const vendorSelection = document.getElementById('vendor-selection');
            const vendorSelect = document.getElementById('vendor_id');

            if (complaintType === 'vendor_specific') {
                vendorSelection.style.display = 'block';
                vendorSelect.required = true;
            } else {
                vendorSelection.style.display = 'none';
                vendorSelect.required = false;
                vendorSelect.value = '';
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleVendorSelection();
        });
    </script>
</body>
</html>
