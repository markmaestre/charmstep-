<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Carts</title>
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
            position: relative;
        }
        .back-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
        h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table thead {
            background-color: #007bff;
            color: #fff;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table tbody tr:hover {
            background-color: #f1f1f1;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <button class="back-button" onclick="history.back()">Back</button>
        <h1>All Carts</h1>
        @if($carts->isEmpty())
            <p>No carts found.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Cart ID</th>
                        <th>User ID</th>
                        <th>Item ID</th>
                        <th>Brand Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Size</th>
                        <th>Image</th>
                
                        <th>Date Added</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carts as $cart)
                        <tr>
                            <td>{{ $cart->id }}</td>
                            <td>{{ $cart->user_id }}</td>
                            <td>{{ $cart->item_id }}</td>
                            <td>{{ $cart->brand_name }}</td>
                            <td>{{ $cart->price }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>{{ $cart->size }}</td>
                            <td>
                                @if($cart->image)
                                    <img src="{{ asset('storage/' . $cart->image) }}" alt="{{ $cart->brand_name }}" style="max-width: 100px;">
                                @else
                                    No Image
                                @endif
                            </td>

                            <td>{{ $cart->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
