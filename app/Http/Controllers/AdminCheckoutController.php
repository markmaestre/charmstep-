<?php


// app/Http/Controllers/AdminCheckoutController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Cart;

class AdminCheckoutController extends Controller
{
    public function index()
    {
        $checkouts = Checkout::all();
        return view('admin.checkouts', compact('checkouts'));
    }

    public function show($id)
    {
        $checkout = Checkout::findOrFail($id);
        $cartItems = Cart::where('id', $checkout->cart_id)->get();

        return view('admin.checkout-details', compact('checkout', 'cartItems'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'required|string|in:processing,completed',
        ]);
    
        $checkout = Checkout::findOrFail($id);
        $checkout->status = $validatedData['status'];
        $checkout->save();
    
        return redirect()->route('admin.checkout.show', $id)->with('success', 'Status updated successfully.');
    }
}    