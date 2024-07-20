<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Your Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Include the styling here */
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Cart</h1>

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
