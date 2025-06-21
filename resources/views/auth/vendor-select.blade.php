<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Select Vendor | UTM Commerce Connect</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 3rem;
            animation: fadeInDown 0.8s ease-out;
        }

        .logo-section img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            background: #fff;
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }

        .logo-section img:hover {
            transform: scale(1.05) rotate(5deg);
        }

        .logo-section h1 {
            color: #fff;
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
            text-shadow: 0 4px 16px rgba(0,0,0,0.3);
        }

        .logo-section p {
            color: rgba(255,255,255,0.9);
            font-size: 1.1rem;
            margin: 0.5rem 0 0 0;
            text-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .main-container {
            width: 90%;
            max-width: 900px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 16px 64px rgba(0,0,0,0.2);
            padding: 3rem 2rem;
            animation: fadeInUp 0.8s ease-out 0.3s both;
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .header h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #2d3748;
            margin: 0 0 0.5rem 0;
        }

        .header p {
            color: #718096;
            font-size: 1.1rem;
            margin: 0;
        }

        .vendor-cards {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .vendor-card {
            display: flex;
            align-items: center;
            padding: 1.5rem;
            background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
            border-radius: 16px;
            text-decoration: none;
            color: inherit;
            border: 2px solid transparent;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .vendor-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .vendor-card:hover::before {
            opacity: 1;
        }

        .vendor-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            border-color: #667eea;
        }

        .vendor-icon {
            width: 80px;
            height: 80px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #fff;
            margin-right: 1.5rem;
            position: relative;
            z-index: 1;
            transition: transform 0.3s ease;
        }

        .vendor-card:hover .vendor-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .utm-mart { background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%); }
        .setepak { background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); }
        .richiamo { background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%); }

        .vendor-info {
            flex: 1;
            position: relative;
            z-index: 1;
        }

        .vendor-name {
            font-size: 1.4rem;
            font-weight: 700;
            color: #2d3748;
            margin: 0 0 0.5rem 0;
            transition: color 0.3s ease;
        }

        .vendor-card:hover .vendor-name {
            color: #667eea;
        }

        .vendor-description {
            color: #718096;
            font-size: 1rem;
            margin: 0 0 0.5rem 0;
            line-height: 1.5;
        }

        .vendor-status {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(72, 187, 120, 0.1);
            color: #38a169;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .vendor-arrow {
            font-size: 1.5rem;
            color: #a0aec0;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .vendor-card:hover .vendor-arrow {
            color: #667eea;
            transform: translateX(8px);
        }

        @media (max-width: 768px) {
            .main-container {
                width: 95%;
                padding: 2rem 1.5rem;
                margin: 0 1rem;
            }

            .logo-section h1 {
                font-size: 2rem;
            }

            .vendor-card {
                flex-direction: column;
                text-align: center;
                padding: 2rem 1.5rem;
            }

            .vendor-icon {
                margin-right: 0;
                margin-bottom: 1rem;
            }

            .vendor-arrow {
                display: none;
            }

            .header h2 {
                font-size: 1.6rem;
            }
        }

        @media (max-width: 480px) {
            .logo-section {
                margin-bottom: 2rem;
            }

            .logo-section img {
                width: 100px;
                height: 100px;
            }

            .vendor-cards {
                gap: 1rem;
            }

            .vendor-card {
                padding: 1.5rem 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="logo-section">
        <img src="{{ asset('images/logo-for-commerce.jpg') }}" alt="UTM Commerce Connect Logo">
        <h1>UTM Commerce Connect</h1>
        <p>Choose your preferred vendor to continue</p>
    </div>

    <div class="main-container">
        <div class="header">
            <h2>Select Your Vendor</h2>
            <p>Click on any vendor below to access their login portal</p>
        </div>

        <div class="vendor-cards">
            <a href="{{ route('vendor.login.utm_mart.form') }}" class="vendor-card">
                <div class="vendor-icon utm-mart">
                    <i class="fas fa-store"></i>
                </div>
                <div class="vendor-info">
                    <h3 class="vendor-name">UTM Mart</h3>
                    <p class="vendor-description">University merchandise, books, stationery and essential items for students</p>
                    <span class="vendor-status">
                        <i class="fas fa-circle"></i>
                        Online
                    </span>
                </div>
                <div class="vendor-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>

            <a href="{{ route('vendor.login.setepak.form') }}" class="vendor-card">
                <div class="vendor-icon setepak">
                    <i class="fas fa-print"></i>
                </div>
                <div class="vendor-info">
                    <h3 class="vendor-name">Setepak Printing Service KTF</h3>
                    <p class="vendor-description">Professional printing services for academic and business needs</p>
                    <span class="vendor-status">
                        <i class="fas fa-circle"></i>
                        Online
                    </span>
                </div>
                <div class="vendor-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>

            <a href="{{ route('vendor.login.richiamo.form') }}" class="vendor-card">
                <div class="vendor-icon richiamo">
                    <i class="fas fa-mug-hot"></i>
                </div>
                <div class="vendor-info">
                    <h3 class="vendor-name">Richiamo Caffe</h3>
                    <p class="vendor-description">Premium coffee, beverages, and delicious food for coffee lovers</p>
                    <span class="vendor-status">
                        <i class="fas fa-circle"></i>
                        Online
                    </span>
                </div>
                <div class="vendor-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>
        </div>

        <div class="back-link" style="text-align: center; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(113, 128, 150, 0.2);">
            <a href="{{ route('login') }}" style="color: #667eea; text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.3s ease; padding: 0.75rem 1.5rem; background: rgba(102, 126, 234, 0.1); border-radius: 8px;">
                <i class="fas fa-arrow-left"></i>
                Back to User Login
            </a>
        </div>
    </div>
</body>
</html>
