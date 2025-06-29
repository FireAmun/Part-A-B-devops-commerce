<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refactoring Benchmark Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
        }
        .header {
            background: linear-gradient(to right, #4b6cb7, #182848);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }
        .card {
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
            border: none;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .code-smell-title {
            color: #e74c3c;
            font-weight: 600;
        }
        .refactor-title {
            color: #27ae60;
            font-weight: 600;
        }
        .performance-card {
            background: #f8f9fa;
            border-left: 5px solid #3498db;
        }
        .benchmark-result {
            font-size: 1.2rem;
            font-weight: 600;
        }
        .improvement {
            font-size: 1.5rem;
            color: #27ae60;
        }
        .code {
            background: #f8f9fa;
            border-left: 5px solid #3498db;
            padding: 1rem;
            border-radius: 5px;
            font-family: monospace;
            white-space: pre-wrap;
            overflow-x: auto;
        }
        hr.divider {
            border: 0;
            height: 1px;
            background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
            margin: 2rem 0;
        }
        .footer {
            margin-top: 3rem;
            padding: 1.5rem 0;
            background-color: #f8f9fa;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="header text-center">
        <div class="container">
            <h1 class="display-4">Code Refactoring Benchmark Results</h1>
            <p class="lead">Comparing the performance of original code vs refactored code</p>
        </div>
    </div>

    <div class="container">
        <!-- Show error message if there is one -->
        @if(isset($error))
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @else
            <!-- Benchmark Results Section -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card performance-card p-4">
                        <h2 class="card-title mb-4">Performance Comparison
                            <span class="badge bg-secondary">{{ $iterations }} iterations</span>
                            <span class="badge bg-info">{{ $operationsPerProduct ?? 1 }} operations per product</span>
                        </h2>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center mb-3">
                                    <h5>Original Code</h5>
                                    <p class="benchmark-result">{{ number_format($originalTime, 2) }} ms</p>
                                    <small class="text-muted">Average execution time</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center mb-3">
                                    <h5>Refactored Code</h5>
                                    <p class="benchmark-result">{{ number_format($refactoredTime, 2) }} ms</p>
                                    <small class="text-muted">Average execution time</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center mb-3">
                                    <h5>Improvement</h5>
                                    <p class="improvement">{{ number_format($improvement, 1) }}%</p>
                                    <small class="text-muted">Performance gain</small>
                                    @if(isset($rawImprovement) && $rawImprovement != $improvement)
                                        <small class="d-block text-muted">(Raw: {{ number_format($rawImprovement, 1) }}%)</small>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="progress mt-3">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: {{ $improvement }}%"
                                aria-valuenow="{{ $improvement }}"
                                aria-valuemin="0"
                                aria-valuemax="100">
                                {{ number_format($improvement, 1) }}%
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Refactoring Summary Section -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card p-4">
                        <h2 class="mb-4">Refactoring Summary</h2>

                        <h4 class="code-smell-title">Code Smells Identified:</h4>
                        <ul class="mb-4">
                            <li><strong>Hard-coded Data:</strong> Product data was hard-coded in controllers instead of using database.</li>
                            <li><strong>Complex Business Logic in Controller:</strong> Cart logic was directly in the controller, violating Single Responsibility Principle.</li>
                            <li><strong>Inconsistent Model Relationships:</strong> Missing or incorrect relationships between models.</li>
                        </ul>

                        <h4 class="refactor-title">Refactoring Approaches:</h4>
                        <ul>
                            <li><strong>Created a Service Layer:</strong> Moved cart business logic to a dedicated CartService class.</li>
                            <li><strong>Used Database Seeders:</strong> Moved hard-coded product data to database seeders.</li>
                            <li><strong>Fixed Model Relationships:</strong> Implemented proper Eloquent relationships.</li>
                            <li><strong>Improved Method Organization:</strong> Broke down complex methods into smaller, focused methods.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Code Comparison Section -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card p-4">
                        <h2 class="mb-4">Code Structure Comparison</h2>

                        <h5>Original Approach (All in Controller):</h5>
                        <div class="code mb-4">
CartController handles everything:
- Business logic
- Cart operations
- Session management
- Response handling</div>

                        <h5>Refactored Approach (Service Layer Pattern):</h5>
                        <div class="code">
CartController:
- Handles HTTP requests
- Delegates to CartService
- Returns responses

CartService:
- Contains all business logic
- Manages cart operations
- Handles session operations
- Provides data to controller</div>
                    </div>
                </div>
            </div>

            <!-- Detailed Iterations Data -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card p-4">
                        <h2 class="mb-4">Benchmark Iteration Details</h2>
                        <p class="text-muted mb-4">Results from each of the {{ $iterations }} benchmark iterations</p>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Iteration</th>
                                        <th>Original Code (ms)</th>
                                        <th>Refactored Code (ms)</th>
                                        <th>Difference (ms)</th>
                                        <th>Improvement</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($originalTimes as $i => $originalTime)
                                        @php
                                            $diff = $originalTime - $refactoredTimes[$i];
                                            $iterImprovement = $originalTime > 0 ? (($diff) / $originalTime) * 100 : 0;
                                        @endphp
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ number_format($originalTime, 2) }}</td>
                                            <td>{{ number_format($refactoredTimes[$i], 2) }}</td>
                                            <td>{{ number_format($diff, 2) }}</td>
                                            <td>
                                                <span class="{{ $iterImprovement >= 0 ? 'text-success' : 'text-danger' }}">
                                                    {{ number_format($iterImprovement, 1) }}%
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <th>Average</th>
                                        <th>{{ number_format(array_sum($originalTimes) / count($originalTimes), 2) }}</th>
                                        <th>{{ number_format(array_sum($refactoredTimes) / count($refactoredTimes), 2) }}</th>
                                        <th>{{ number_format((array_sum($originalTimes) / count($originalTimes)) - (array_sum($refactoredTimes) / count($refactoredTimes)), 2) }}</th>
                                        <th>
                                            <span class="text-success font-weight-bold">
                                                {{ number_format($improvement, 1) }}%
                                            </span>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="text-center mt-4 mb-5">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
        </div>
    </div>

    <div class="footer text-center">
        <div class="container">
            <p>Code Refactoring Demonstration - Laravel E-commerce Project</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
