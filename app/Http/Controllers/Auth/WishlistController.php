<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Imports\WishlistsImport;
use Maatwebsite\Excel\Facades\Excel;
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

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        if (!$request->hasFile('file')) {
            Log::error('File not uploaded');
            return response()->json(['error' => 'File not uploaded'], 422);
        }

        try {
            Log::info('Uploaded file details: ' . $request->file('file')->getClientOriginalName());
            Excel::import(new WishlistsImport, $request->file('file'));
            return response()->json(['success' => 'Excel file imported successfully.', 'status' => 200]);
        } catch (\Exception $e) {
            Log::error('Error importing Excel file: ' . $e->getMessage());
            return response()->json(['error' => 'Error importing Excel file: ' . $e->getMessage()], 500);
        }
    }
}
