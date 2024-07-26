<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Reviews</title>
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
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }
        h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }
        .back-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
        .review-box {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .review-header {
            font-size: 24px;
            color: #007bff;
            margin-bottom: 10px;
            text-align: left;
            font-weight: bold;
        }
        .average-rating {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: left;
        }
        .star-rating {
            color: gold;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table th {
            background-color: #007bff;
            color: white;
            padding: 12px;
            text-align: left;
        }
        table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table tbody tr:hover {
            background-color: #f1f1f1;
        }
        img {
            max-width: 100px;
            height: auto;
            border-radius: 5px;
        }
        .no-reviews {
            text-align: center;
            font-size: 20px;
            color: #888;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ url()->previous() }}" class="back-button">Back</a>
        <h1>All Reviews</h1>
        @if($reviews->isEmpty())
            <p class="no-reviews">No reviews found.</p>
        @else
            @foreach($reviews as $review)
                <div class="review-box">
                    <div class="review-header">Reviews for Checkout ID: <span style="color: #555;">{{ $review->checkout_id }}</span></div>
                    <div class="average-rating">Average Rating: <span style="color: #007bff;">{{ number_format($review->average_rating, 1) }}</span></div>
                    <div class="star-rating">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="star">{{ $i <= round($review->average_rating) ? '★' : '☆' }}</span>
                        @endfor
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Description</th>
                                <th>Rating</th>
                                <th>Photo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allReviews->where('checkout_id', $review->checkout_id) as $singleReview)
                                <tr>
                                    <td>{{ $singleReview->user_id }}</td>
                                    <td>{{ $singleReview->description }}</td>
                                    <td>
                                        <div class="star-rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <span class="star">{{ $i <= $singleReview->rating ? '★' : '☆' }}</span>
                                            @endfor
                                        </div>
                                    </td>
                                    <td>
                                        @if($singleReview->photo)
                                            <img src="{{ asset('storage/' . $singleReview->photo) }}" alt="Review Photo">
                                        @else
                                            <span>No Photo</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>
