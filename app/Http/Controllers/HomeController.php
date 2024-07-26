<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch new items (items created in the last 24 hours)
        $newItems = Item::where('created_at', '>=', now()->subDay())->get();

        // Fetch old items (items older than 24 hours)
        $oldItems = Item::where('created_at', '<', now()->subDay())->get();

        return view('homepage', compact('newItems', 'oldItems'));
    }
}
