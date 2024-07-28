<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout History</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #333;
            text-align: center;
        }
        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            text-align: center;
            margin-bottom: 20px;
            cursor: pointer;
        }
        .btn-back:hover {
            background-color: #0056b3;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .table thead {
            background-color: #007bff;
            color: #fff;
        }
        .table th, .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .table a {
            color: #007bff;
            text-decoration: none;
        }
        .table a:hover {
            text-decoration: underline;
        }
        p {
            font-size: 16px;
            color: #555;
            text-align: center;
        }
        .alert {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
        }
        .alert.alert-success {
            color: #28a745;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .alert.alert-danger {
            color: #dc3545;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <button class="btn-back" onclick="window.history.back()">Back</button>
        <h1>Checkout History</h1>
        @if($checkoutHistory->isEmpty())
            <p>You have no past checkouts.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Checkout ID</th>
                        <th>Date</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($checkoutHistory as $checkout)
                        <tr>
                            <td>{{ $checkout->checkout_id }}</td>
                            <td>{{ $checkout->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>{{ $checkout->total_amount }}</td>
                            <td>{{ $checkout->status }}</td>
                            <td><a href="{{ route('checkout.details', $checkout->checkout_id) }}">View Details</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
