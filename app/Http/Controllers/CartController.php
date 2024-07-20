<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Checkout;

class CartController extends Controller
{
    public function view()
    {
        $userId = auth()->user()->id;
        $cartItems = Cart::where('user_id', $userId)->get();

        $grandTotal = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });

        return view('cart.view', compact('cartItems', 'grandTotal'));
    }

    public function addToCart(Request $request)
    {
        $validatedData = $request->validate([
            'item_id' => 'required|exists:items,item_id',
            'user_id' => 'required|exists:users,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $item = Item::where('item_id', $validatedData['item_id'])->first();
        
        if ($item->quantity < $validatedData['quantity']) {
            return response()->json(['error' => 'Not enough items in stock.'], 400);
        }

        $cartItem = Cart::where('user_id', $validatedData['user_id'])
                         ->where('item_id', $validatedData['item_id'])
                         ->first();
        
        if ($cartItem) {
            $cartItem->quantity += $validatedData['quantity'];
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $validatedData['user_id'],
                'item_id' => $validatedData['item_id'],
                'brand_name' => $item->product_name,
                'price' => $item->price,
                'quantity' => $validatedData['quantity'],
                'size' => $item->size,
                'image' => $item->image,
                'status' => 'pending',
            ]);
        }

        // Decrement the item quantity in inventory
        $item->quantity -= $validatedData['quantity'];
        $item->save();

        return response()->json(['success' => 'Item added to cart successfully.']);
    }

    public function delete($id)
    {
        $cartItem = Cart::findOrFail($id);
        
        if ($cartItem->user_id !== auth()->user()->id) {
            return redirect()->route('cart.view')->with('error', 'Unauthorized action.');
        }

        $cartItem->delete();

        return redirect()->route('cart.view')->with('success', 'Item removed from cart.');
    }

    public function deleteAll()
    {
        $userId = auth()->user()->id;

        if (!auth()->check()) {
            return redirect()->route('cart.view')->with('error', 'User not authenticated.');
        }

        Cart::where('user_id', $userId)->delete();

        return redirect()->route('cart.view')->with('success', 'All items removed from cart.');
    }

    public function showCheckout()
    {
        // Display the checkout form
        return view('cart.checkout');
    }

    public function checkout(Request $request)
    {
        $validatedData = $request->validate([
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $userId = auth()->user()->id;
        $cartItems = Cart::where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Cart is empty.');
        }

        $totalAmount = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        // Create a checkout record
        $cartId = $cartItems->pluck('id')->first(); // Use the cart_id of the first item

        $checkout = Checkout::create([
            'user_id' => $userId,
            'cart_id' => $cartId,
            'address' => $validatedData['address'],
            'phone_number' => $validatedData['phone_number'],
            'payment_method' => $validatedData['payment_method'],
            'total_amount' => $totalAmount,
            'status' => 'processing',
        ]);

        if ($checkout) {
            // Update the status of each cart item to 'processing'
            Cart::where('user_id', $userId)->update(['status' => 'processing']);

            return redirect()->route('checkout.success')->with('success', 'Checkout successful.');
        } else {
            return redirect()->route('cart.view')->with('error', 'Checkout failed.');
        }
    }
}
