<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        
        $newItems = Item::where('created_at', '>=', now()->subDay())->get();

  
        $oldItems = Item::where('created_at', '<', now()->subDay())->get();

        return view('homepage', compact('newItems', 'oldItems'));
    }
}
