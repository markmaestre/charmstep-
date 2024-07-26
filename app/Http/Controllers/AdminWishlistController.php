<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist; // Import the Wishlist model

class AdminWishlistController extends Controller
{
    public function index()
    {
        // Fetch all wishlists
        $wishlists = Wishlist::all();
        return view('admin.wishlists.index', compact('wishlists'));
    }
}
