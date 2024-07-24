<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        return response()->json($reviews);
    }

    public function store(Request $request)
    {
        $request->validate([
            'checkout_id' => 'required|exists:checkouts,checkout_id',
            'description' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'photo' => 'nullable|image'
        ]);

        $review = new Review();
        $review->checkout_id = $request->checkout_id;
        $review->user_id = Auth::id(); // Set the logged-in user's ID
        $review->description = $request->description;
        $review->rating = $request->rating;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $review->photo = $photoPath;
        }

        $review->save();

        return response()->json(['success' => 'Review added successfully']);
    }

    public function show($id)
    {
        $review = Review::find($id);
        if ($review) {
            return response()->json($review);
        } else {
            return response()->json(['error' => 'Review not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'checkout_id' => 'required|exists:checkouts,checkout_id',
            'description' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'photo' => 'nullable|image'
        ]);

        $review = Review::find($id);
        if ($review) {
            $review->checkout_id = $request->checkout_id;
            $review->description = $request->description;
            $review->rating = $request->rating;

            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('photos', 'public');
                $review->photo = $photoPath;
            }

            $review->save();

            return response()->json(['success' => 'Review updated successfully']);
        } else {
            return response()->json(['error' => 'Review not found'], 404);
        }
    }

    public function destroy($id)
    {
        $review = Review::find($id);
        if ($review) {
            $review->delete();
            return response()->json(['success' => 'Review deleted successfully']);
        } else {
            return response()->json(['error' => 'Review not found'], 404);
        }
    }
}
