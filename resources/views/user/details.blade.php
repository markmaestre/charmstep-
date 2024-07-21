<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Details</title>
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
        h1, h2, h3 {
            color: #333;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 28px;
        }
        h2 {
            font-size: 24px;
        }
        h3 {
            font-size: 20px;
            margin-top: 20px;
        }
        p {
            font-size: 16px;
            color: #555;
            margin: 10px 0;
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
        .table img {
            max-width: 100px;
            height: auto;
            border-radius: 4px;
        }
        .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Checkout Details</h1>
        <h2>Checkout ID: {{ $checkout->checkout_id }}</h2>
        <p><strong>Date:</strong> {{ $checkout->created_at->format('Y-m-d H:i:s') }}</p>
        <p><strong>Total Amount:</strong> {{ $checkout->total_amount }}</p>
        <p><strong>Status:</strong> {{ $checkout->status }}</p>
        <h3>Items:</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Brand Name</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->item->product_name ?? 'N/A' }}</td>
                        <td>{{ $item->brand_name }}</td>
                        <td>{{ $item->size }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>
                            @if($item->item->image)
                                <img src="{{ asset('storage/' . $item->item->image) }}" alt="{{ $item->item->product_name }}">
                            @else
                                No Image
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
