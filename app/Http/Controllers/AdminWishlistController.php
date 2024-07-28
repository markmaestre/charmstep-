<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist; 

class AdminWishlistController extends Controller
{
    public function index()
    {
        
        $wishlists = Wishlist::all();
        return view('admin.wishlists.index', compact('wishlists'));
    }
}
