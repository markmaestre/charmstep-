<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class WishlistController extends Controller
{
    public function index()
    {
        
        $user = auth()->user();


        $wishlists = Wishlist::where('user_id', $user->id)->get();

        return response()->json($wishlists);
    }

    public function store(Request $request)
    {
        $wishlist = new Wishlist();
        $wishlist->user_id = auth()->id();
        $wishlist->brand_name = $request->brand_name;
        $wishlist->size = $request->size;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('public/images');
            $wishlist->image = $path;
        }

        $wishlist->save();

        return response()->json(['success' => 'Wishlist item created successfully.', 'wishlist' => $wishlist, 'status' => 200]);
    }

    public function show($id)
    {
        $wishlist = Wishlist::where('wishlist_id', $id)->where('user_id', auth()->id())->first();
        return response()->json($wishlist);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        $wishlist = Wishlist::where('wishlist_id', $id)->where('user_id', auth()->id())->first();

        $wishlist->brand_name = $request->brand_name;
        $wishlist->size = $request->size;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->storeAs('public/images', $file->getClientOriginalName());
            $wishlist->image = 'storage/images/' . $file->getClientOriginalName();
        }

        $wishlist->save();

        return response()->json([
            "success" => "Wishlist item updated successfully.",
            "wishlist" => $wishlist,
            "status" => 200
        ]);
    }

    public function destroy($id)
    {
        $wishlist = Wishlist::where('wishlist_id', $id)->where('user_id', auth()->id())->first();
        $wishlist->delete();

        return response()->json([
            "success" => "Wishlist item deleted successfully.",
            "status" => 200
        ]);
    }
}
