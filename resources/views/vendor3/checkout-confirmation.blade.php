@php
    use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation - Setepak Printing Service KTF</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #16a34a;
            --primary-dark: #15803d;
            --secondary: #22c55e;
            --accent: #86efac;
            --success: #059669;
            --danger: #dc2626;
            --text: #064e3b;
            --text-light: #059669;
            --white: #ffffff;
            --light-green: #f0fdf4;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --shadow: 0 10px 25px rgba(22, 163, 74, 0.15);
            --transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, var(--light-green), var(--white));
            margin: 0;
            padding: 0;
            min-height: 100vh;
            color: var(--text);
            line-height: 1.5;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 2rem;
            background: var(--white);
            border-radius: 16px;
            box-shadow: var(--shadow);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            background: var(--gray-100);
            color: var(--primary-dark);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.25rem;
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
            text-decoration: none;
        }

        .back-btn:hover {
            background: var(--gray-200);
            transform: translateY(-2px);
        }

        h2 {
            color: var(--primary-dark);
            margin-bottom: 2rem;
            font-size: 1.75rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        h2::before {
            content: '\f02f';
            font-family: 'Font Awesome 6 Free';
            color: var(--primary);
        }

        .order-summary {
            background: var(--light-green);
            padding: 1.5rem;
            border-radius: 12px;
            margin: 2rem 0;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 2px solid var(--gray-200);
            font-weight: 600;
            font-size: 1.25rem;
            color: var(--text);
        }

        .qr-section {
            text-align: center;
            margin: 2rem 0;
            padding: 1.75rem;
            background: var(--light-green);
            border-radius: 12px;
            border: 1px solid var(--gray-200);
        }

        .qr-section h3 {
            color: var(--text);
            margin-bottom: 1rem;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .qr-section h3::before {
            content: '\f029';
            font-family: 'Font Awesome 6 Free';
            color: var(--primary);
        }

        .qr-section img {
            width: 220px;
            height: 220px;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(22, 163, 74, 0.2);
            transition: var(--transition);
        }

        .qr-section img:hover {
            transform: scale(1.05);
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
            background: var(--light-green);
            font-family: inherit;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
        }

        .submit-btn {
            width: 100%;
            background: var(--primary);
            color: var(--white);
            border: none;
            padding: 1.25rem;
            border-radius: 12px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 600;
            font-size: 1.1rem;
            margin-top: 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .submit-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .error {
            color: var(--danger);
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .error::before {
            content: '\f071';
            font-family: 'Font Awesome 6 Free';
            font-size: 0.875rem;
        }

        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 1.5rem;
            }

            .qr-section img {
                width: 180px;
                height: 180px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('vendor3.cart.view') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Back to Cart
        </a>

        <h2>Complete Your Printing Order</h2>

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <div class="order-summary">
            <h3 style="color: var(--primary-dark); margin-bottom: 1rem;">Printing Order Summary</h3>
            @php $total = 0; @endphp
            @foreach($cart as $item)
                <div class="summary-item">
                    <span>{{ $item['name'] }} (x{{ $item['qty'] }})</span>
                    <span>RM{{ number_format($item['price'] * $item['qty'], 2) }}</span>
                </div>
                @php $total += $item['price'] * $item['qty']; @endphp
            @endforeach
            <div class="summary-total">
                <span>Total</span>
                <span>RM{{ number_format($total, 2) }}</span>
            </div>
        </div>

        <div class="qr-section">
            <h3>Payment QR Code</h3>
            <p style="margin-bottom: 1rem; color: var(--text-light);">
                Scan this QR code to make your payment securely
            </p>
            <img src="{{ asset('images/qr-print.jpeg') }}" alt="Setepak Printing Service Payment QR Code">
        </div>

        <form method="POST" action="{{ route('vendor3.checkout.placeOrder') }}" enctype="multipart/form-data">
            @csrf

            @php
                $user = Auth::user();
            @endphp

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" value="{{ old('name', $user->name ?? '') }}" readonly class="form-control-plaintext" style="background-color: var(--light-green); color: var(--text-light);">
                <small style="color: var(--text-light);">Submitting as {{ $user->name ?? 'Guest' }}</small>
                <input type="hidden" name="name" value="{{ $user->name ?? '' }}">
                @error('name') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" value="{{ old('email', $user->email ?? '') }}" readonly class="form-control-plaintext" style="background-color: var(--light-green); color: var(--text-light);">
                <small style="color: var(--text-light);">Order confirmation will be sent to this email</small>
                <input type="hidden" name="email" value="{{ $user->email ?? '' }}">
                @error('email') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone Number *</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="Enter your phone number">
                @error('phone') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="vendor_id">Select Vendor *</label>
                <select name="vendor_id" id="vendor_id" required>
                    <option value="">-- Choose Vendor --</option>
                    <option value="1" {{ old('vendor_id') == 1 ? 'selected' : '' }}>UTM Mart</option>
                    <option value="2" {{ old('vendor_id') == 2 ? 'selected' : '' }} selected>Setepak Printing Service KTF</option>
                    <option value="3" {{ old('vendor_id') == 3 ? 'selected' : '' }}>Richiamo Caffe</option>
                </select>
                @error('vendor_id') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="notes">Order Notes (Optional)</label>
                <textarea id="notes" name="notes" rows="3" placeholder="Any special printing instructions... (e.g., paper type, color preferences, delivery instructions, etc.)">{{ old('notes') }}</textarea>
                <small style="color: var(--text-light);">Let us know your printing specifications and requirements</small>
                @error('notes') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="print_file">Print File (Optional)</label>
                <input type="file" id="print_file" name="print_file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                <small style="color: var(--text-light);">Upload the file you want to print (PDF, DOC, DOCX, JPG, PNG)</small>
                @error('print_file') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="payment_proof">Payment Proof *</label>
                <input type="file" id="payment_proof" name="payment_proof" accept="image/*" required>
                <small style="color: var(--text-light);">Upload screenshot or photo of your payment receipt</small>
                @error('payment_proof') <div class="error">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="submit-btn">
                <i class="fas fa-print"></i>
                Place Printing Order
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const submitBtn = form.querySelector('.submit-btn');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing Printing Order...';

                // Create a floating success message
                const successMsg = document.createElement('div');
                successMsg.style.position = 'fixed';
                successMsg.style.top = '20px';
                successMsg.style.left = '50%';
                successMsg.style.transform = 'translateX(-50%)';
                successMsg.style.backgroundColor = '#dcfce7';
                successMsg.style.color = '#166534';
                successMsg.style.padding = '15px 20px';
                successMsg.style.borderRadius = '8px';
                successMsg.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
                successMsg.style.zIndex = '9999';
                successMsg.style.textAlign = 'center';
                successMsg.style.fontWeight = 'bold';
                successMsg.style.minWidth = '300px';
                successMsg.innerHTML = '<i class="fas fa-check-circle"></i> Printing order submitted successfully! Redirecting to orders page...';

                document.body.appendChild(successMsg);
            });
        });
    </script>
</body>
</html>
