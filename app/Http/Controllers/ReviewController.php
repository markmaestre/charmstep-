<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $reviews = Review::with('checkout')
                ->where('user_id', auth()->id())
                ->get();

            return DataTables::of($reviews)
                ->addColumn('action', function ($review) {
                    return "
                        <button class='btn btn-info editbtn' data-id='{$review->review_id}' data-toggle='modal' data-target='#reviewModal'>Edit</button>
                        <button class='btn btn-danger deletebtn' data-id='{$review->review_id}'>Delete</button>
                    ";
                })
                ->addColumn('photo', function ($review) {
                    return $review->photo ? "<img src='" . Storage::url($review->photo) . "' width='100'>" : 'No Photo';
                })
                ->rawColumns(['action', 'photo'])
                ->make(true);
        }

        $checkouts = Checkout::where('user_id', auth()->id())
            ->where('status', 'completed')
            ->get();
        return view('reviews.index', compact('checkouts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'checkout_id' => 'required|exists:checkouts,checkout_id',
            'description' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $photoPath = $request->file('photo') ? $request->file('photo')->store('photos', 'public') : null;

        Review::create([
            'checkout_id' => $request->checkout_id,
            'user_id' => auth()->id(),
            'description' => $request->description,
            'rating' => $request->rating,
            'photo' => $photoPath,
        ]);

        return response()->json(['success' => 'Review added successfully.']);
    }

    public function update(Request $request, $id)
    {
        $review = Review::where('review_id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Removed validation for update
        // $request->validate([
        //     'checkout_id' => 'required|exists:checkouts,checkout_id',
        //     'description' => 'required',
        //     'rating' => 'required|integer|min:1|max:5',
        //     'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        // ]);

        $photoPath = $request->file('photo') ? $request->file('photo')->store('photos', 'public') : $review->photo;

        $review->update([
            'checkout_id' => $request->checkout_id,
            'description' => $request->description,
            'rating' => $request->rating,
            'photo' => $photoPath,
        ]);

        return response()->json(['success' => 'Review updated successfully.']);
    }

    public function destroy($id)
    {
        $review = Review::where('review_id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($review->photo) {
            Storage::disk('public')->delete($review->photo);
        }

        $review->delete();
        return response()->json(['success' => 'Review deleted successfully.']);
    }

    public function edit($id)
    {
        $review = Review::where('review_id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        return response()->json($review);
    }
}