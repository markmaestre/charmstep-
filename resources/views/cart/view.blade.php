<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Your Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .box-container {
            background-color: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 8px;
            padding: 20px;
            margin: 50px auto;
            max-width: 800px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .heading {
            margin-bottom: 20px;
            color: #007bff;
            font-size: 28px;
            text-align: center;
            text-transform: uppercase;
        }

        .btn-container {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .btn-container a {
            color: #fff;
            background-color: #007bff;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin-left: 10px;
            display: inline-block;
        }

        .btn-container a i {
            margin-right: 5px;
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            color: #fff;
        }

        .alert-success {
            background-color: #28a745;
        }

        .alert-danger {
            background-color: #dc3545;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ced4da;
        }

        .cart-item img {
            height: 80px;
            margin-right: 20px;
        }

        .details {
            flex: 1;
        }

        .actions {
            margin-left: auto;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .update-quantity-container {
            display: flex;
            align-items: center;
        }

        .update-quantity-container input {
            width: 40px;
            margin-right: 10px;
            padding: 8px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            text-align: center;
            font-size: 14px;
        }

        .update-quantity-container button {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 14px;
        }

        .update-quantity-container button:hover {
            background-color: #218838;
        }

        .action-buttons {
            margin-top: 20px;
            text-align: center;
        }

        .action-buttons .btn {
            background-color: #28a745;
            color: #fff;
            margin: 0 5px;
        }

        .action-buttons .btn:hover {
            background-color: #218838;
        }

        .action-buttons form {
            display: inline;
        }

        .action-buttons p {
            font-size: 16px;
            font-weight: bold;
            margin: 10px 0;
        }

        .table-bottom td {
            font-weight: bold;
            background-color: #f8f9fa;
            font-size: 16px;
        }

        .payment-status {
            font-weight: bold;
            color: green;
        }
    </style>
</head>
<body>
    <div class="box-container">
        <div class="btn-container">
            <a href="{{ url('/user/dashboard') }}" class="btn"> <i class="fas fa-arrow-left"></i> Back</a>
            <a href="{{ url('/shop') }}" class="btn">Shop</a>
        </div>
        <h1 class="heading">Your Cart</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @php $grandTotal = 0; @endphp

        @if ($cartItems->count() > 0)
            @foreach ($cartItems as $item)
                @if ($item->status === 'pending')
                    @php $grandTotal += $item->price * $item->quantity; @endphp
                    <div class="cart-item">
                        <img src="/storage/{{ $item->image }}" alt="{{ $item->product_name }}">
                        <div class="details">
                            <h4>{{ $item->product_name }}</h4>
                            <p>Price: ${{ $item->price }}</p>
                            <p>Quantity: {{ $item->quantity }}</p>
                            <p>Size: {{ $item->size }}</p>
                        </div>
                        <div class="actions">
                            <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn">Delete</button>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach

            <div class="action-buttons">
                <form action="{{ route('cart.deleteAll') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn">Delete All Items</button>
                </form>
                <p><strong>Grand Total: ${{ $grandTotal }}</strong></p>
                <a href="{{ route('cart.checkout.form') }}" class="btn">Proceed to Checkout</a>
            </div>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
</body>
</html>
