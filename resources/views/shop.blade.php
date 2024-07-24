<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .item-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .item-box {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: calc(25% - 20px); 
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .item-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }
        .item-box img {
            width: 100%;
            height: 200px; 
            object-fit: cover;
        }
        .item-box .details {
            padding: 15px;
        }
        .item-box h4 {
            margin: 0 0 10px;
            font-size: 20px;
            color: #333;
        }
        .item-box p {
            margin: 0 0 10px;
            color: #666;
        }
        .stock {
            color: #333;
        }
        .stock.out-of-stock {
            color: red;
            font-weight: bold;
        }
        .addToCartBtn {
            display: inline-block;
            padding: 12px 25px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .addToCartBtn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .quantityInput {
            width: 60px;
            padding: 5px;
            margin-right: 10px;
        }
        .addToCartBtn[disabled] {
            background-color: #cccccc;
            cursor: not-allowed;
        }
        @media (max-width: 1200px) {
            .item-box {
                width: calc(33.33% - 20px);
            }
        }
        @media (max-width: 768px) {
            .item-box {
                width: calc(50% - 20px);
            }
        }
        @media (max-width: 480px) {
            .item-box {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center; margin-bottom: 30px;">Shop Items</h1>
        <div class="item-container">
          
            @foreach ($items as $item)
            <div class="item-box">
                <img src="/storage/{{ $item->image }}" alt="{{ $item->product_name }}">
                <div class="details">
                    <h4>{{ $item->product_name }}</h4>
                    <p>Price: ${{ $item->price }}</p>
                    <p>Size: {{ $item->size }}</p>
                    <p class="stock {{ $item->quantity > 0 ? '' : 'out-of-stock' }}">
                        {{ $item->quantity > 0 ? 'Available: ' . $item->quantity : 'No available stock' }}
                    </p>
                    @if ($item->quantity > 0)
                    <input type="number" class="quantityInput" data-id="{{ $item->item_id }}" min="1" max="{{ $item->quantity }}" value="1">
                    <button class="addToCartBtn" data-id="{{ $item->item_id }}">Add to Cart</button>
                    @else
                    <button class="addToCartBtn" data-id="{{ $item->item_id }}" disabled>Out of Stock</button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>


    <input type="hidden" id="userId" value="{{ auth()->user()->id }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/shop.js') }}"></script>
</body>
</html>
