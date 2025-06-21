<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Service - Setepak Printing Service</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: #f0fdf4;
            margin: 0;
            padding: 2rem;
            color: #064e3b;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(22, 163, 74, 0.1);
            padding: 2rem;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f0fdf4;
        }

        .header h1 {
            color: #16a34a;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #064e3b;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #16a34a;
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }

        .btn-primary {
            background: #16a34a;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background: #15803d;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
            border: none;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }

        .service-types {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .service-type {
            background: #f0fdf4;
            border: 2px solid transparent;
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .service-type:hover,
        .service-type.selected {
            border-color: #16a34a;
            background: white;
        }

        .service-type i {
            font-size: 2rem;
            color: #16a34a;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>
                <i class="fas fa-plus"></i>
                Add New Printing Service
            </h1>
        </div>

        <form id="serviceForm">
            @csrf
            <div class="form-group">
                <label>Service Type</label>
                <div class="service-types">
                    <div class="service-type" onclick="selectService('Business Card Printing', 'fas fa-id-card')">
                        <i class="fas fa-id-card"></i>
                        <div>Business Cards</div>
                    </div>
                    <div class="service-type" onclick="selectService('Banner Printing', 'fas fa-flag')">
                        <i class="fas fa-flag"></i>
                        <div>Banners</div>
                    </div>
                    <div class="service-type" onclick="selectService('Sticker Printing', 'fas fa-tags')">
                        <i class="fas fa-tags"></i>
                        <div>Stickers</div>
                    </div>
                    <div class="service-type" onclick="selectService('Flyer Printing', 'fas fa-file-pdf')">
                        <i class="fas fa-file-pdf"></i>
                        <div>Flyers</div>
                    </div>
                    <div class="service-type" onclick="selectService('Brochure Printing', 'fas fa-book-open')">
                        <i class="fas fa-book-open"></i>
                        <div>Brochures</div>
                    </div>
                    <div class="service-type" onclick="selectService('Photocopy Service', 'fas fa-copy')">
                        <i class="fas fa-copy"></i>
                        <div>Photocopy</div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="name">Service Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="price">Price (RM)</label>
                <input type="number" id="price" name="price" step="0.01" min="0" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="3" placeholder="Describe your printing service..."></textarea>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Add Service
                </button>
                <a href="{{ route('vendor3.products') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <script>
        function selectService(name, icon) {
            // Remove previous selections
            document.querySelectorAll('.service-type').forEach(el => el.classList.remove('selected'));

            // Add selection to clicked element
            event.currentTarget.classList.add('selected');

            // Update form
            document.getElementById('name').value = name;
        }

        document.getElementById('serviceForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Service creation functionality to be implemented');
        });
    </script>
</body>
</html>
