<?php
namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('query');

        $items = Item::where('product_name', 'like', '%' . $query . '%')->get();

        return response()->json($items);
    }
}
