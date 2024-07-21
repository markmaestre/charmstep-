<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Checkout;

class CheckoutController extends Controller
{
    
    public function history()
    {
        $userId = auth()->user()->id;
        $checkoutHistory = Checkout::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
    
        return view('user.history', compact('checkoutHistory'));
    }

    public function details($checkout_id)
{

    $checkout = Checkout::findOrFail($checkout_id);

   
    if ($checkout->user_id !== auth()->user()->id) {
        return redirect()->route('checkout.history')->with('error', 'Unauthorized action.');
    }


    $cartItems = Cart::where('id', $checkout->cart_id)->get();

    return view('user.details', compact('checkout', 'cartItems'));
}

}