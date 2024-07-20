<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;


class ProductController extends Controller
{
    public function index()
    {
        $products = Item::all();
        return response()->json($products);
    }
}
