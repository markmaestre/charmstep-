<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Wishlist</title>
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
        img {
            max-width: 100px; /* Adjust the size as needed */
            height: auto;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <button class="back-button" onclick="history.back()">Back</button>
        <h1>Your Wishlist</h1>
        @if($wishlists->isEmpty())
            <p>No items in your wishlist.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Wishlist ID</th>
                        <th>Brand Name</th>
                        <th>Size</th>
                        <th>Image</th> <!-- Added Image Column -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($wishlists as $wishlist)
                        <tr>
                            <td>{{ $wishlist->wishlist_id }}</td>
                            <td>{{ $wishlist->brand_name }}</td>
                            <td>{{ $wishlist->size }}</td>
                            <td>
                                @if($wishlist->image)
                                    <img src="{{ asset('storage/' . $wishlist->image) }}">
                                @else
                                    No Image
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
