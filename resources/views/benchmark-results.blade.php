<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performance Benchmark Results</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card {
            margin-bottom: 20px;
        }
        .improvement {
            font-weight: bold;
            font-size: 24px;
            margin: 20px 0;
        }
        .improvement.positive {
            color: green;
        }
        .improvement.negative {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Performance Benchmark Results</h1>
        <p class="lead">Comparing original vs. refactored code performance ({{ $iterations }} iterations)</p>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Original Implementation
                    </div>
                    <div class="card-body">
                        <p><strong>Minimum execution time:</strong> {{ number_format($results['original']['min'], 2) }} ms</p>
                        <p><strong>Maximum execution time:</strong> {{ number_format($results['original']['max'], 2) }} ms</p>
                        <p><strong>Average execution time:</strong> {{ number_format($results['original']['avg'], 2) }} ms</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        Refactored Implementation
                    </div>
                    <div class="card-body">
                        <p><strong>Minimum execution time:</strong> {{ number_format($results['refactored']['min'], 2) }} ms</p>
                        <p><strong>Maximum execution time:</strong> {{ number_format($results['refactored']['max'], 2) }} ms</p>
                        <p><strong>Average execution time:</strong> {{ number_format($results['refactored']['avg'], 2) }} ms</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="improvement {{ $improvement >= 0 ? 'positive' : 'negative' }} text-center">
            {{ $improvement >= 0 ? 'Performance Improvement' : 'Performance Degradation' }}: {{ number_format(abs($improvement), 2) }}%
        </div>

        <div class="card">
            <div class="card-header bg-info text-white">
                Summary of Refactoring
            </div>
            <div class="card-body">
                <h5>Code Smells Addressed:</h5>
                <ol>
                    <li><strong>Hard-Coded Product Data:</strong> Moved from controller to database via seeder</li>
                    <li><strong>Complex Conditional Logic:</strong> Simplified with proper methods and cleaner approach</li>
                    <li><strong>Inconsistent Model Relationships:</strong> Fixed relationships between Vendor, VendorLogIn, and Product</li>
                </ol>

                <h5>Refactoring Techniques Applied:</h5>
                <ol>
                    <li><strong>Extract Method:</strong> Split complex methods into smaller, focused ones</li>
                    <li><strong>Extract Class:</strong> Created CartService to handle cart-related logic</li>
                    <li><strong>Move Data to Database:</strong> Product data now stored properly in database</li>
                    <li><strong>Dependency Injection:</strong> Using Laravel's DI for CartService</li>
                    <li><strong>Proper Relationship Modeling:</strong> Fixed model relationships for better architecture</li>
                </ol>
            </div>
        </div>
    </div>
</body>
</html>
