<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::orderBy('item_id', 'DESC')->get();
        return response()->json($items);
    }

    public function show($id)
    {
        $item = Item::find($id);
        
        if (!$item) {
            return response()->json([
                "error" => "Item not found.",
                "status" => 404
            ]);
        }

        return response()->json($item);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
            'size' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $this->storeImage($request);

        try {
            $item = Item::create($request->except('image') + ['image' => $image]);

            return response()->json([
                "success" => "Item created successfully.",
                "item" => $item,
                "status" => 200
            ]);
        } catch (\Exception $e) {
            \Log::error("Error creating item: " . $e->getMessage());

            return response()->json([
                "error" => "Error creating item. Please try again later.",
                "status" => 500
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|string',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
            'size' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                "error" => "Item not found.",
                "status" => 404
            ]);
        }

        $oldImage = $item->image;
        $newImage = $this->storeImage($request, $oldImage);

        try {
            $item->update($request->except('image') + ['image' => $newImage]);

            if ($newImage !== $oldImage && $oldImage) {
                Storage::disk('public')->delete($oldImage);
            }

            return response()->json([
                "success" => "Item updated successfully.",
                "item" => $item,
                "status" => 200
            ]);
        } catch (\Exception $e) {
            \Log::error("Error updating item: " . $e->getMessage());

            return response()->json([
                "error" => "Error updating item. Please try again later.",
                "status" => 500
            ]);
        }
    }

    public function destroy($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                "error" => "Item not found.",
                "status" => 404
            ]);
        }

        try {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }

            $item->delete();

            return response()->json([
                "success" => "Item deleted successfully.",
                "status" => 200
            ]);
        } catch (\Exception $e) {
            \Log::error("Error deleting item: " . $e->getMessage());

            return response()->json([
                "error" => "Error deleting item. Please try again later.",
                "status" => 500
            ]);
        }
    }

    private function storeImage(Request $request, $oldImage = null)
    {
        if ($request->hasFile('image')) {
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
            return $request->file('image')->store('images', 'public');
        }
        return $oldImage;
    }
}

