<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index()
    {
        
        $reviews = Review::with('user')
            ->selectRaw('checkout_id, AVG(rating) as average_rating')
            ->groupBy('checkout_id')
            ->get();

       
        $allReviews = Review::with('user')->get();

        return view('admin.reviews.index', compact('reviews', 'allReviews'));
    }
}