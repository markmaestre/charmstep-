<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function usersChart() {
        $userCount = DB::table('users')
            ->select(DB::raw('role, COUNT(*) as total'))
            ->groupBy('role')
            ->pluck('total', 'role')
            ->all();

        $labels = array_keys($userCount);
        $data = array_values($userCount);

        return response()->json(array('data' => $data, 'labels' => $labels));
    }

    public function itemsQuantityChart() {
        $items = DB::table('items')
            ->select(DB::raw('product_name, quantity'))
            ->pluck('quantity', 'product_name')
            ->all();

        $labels = array_keys($items);
        $data = array_values($items);

        return response()->json(array('data' => $data, 'labels' => $labels));
    }

    public function salesChart() {
        $sales = DB::table('checkouts')
            ->select(DB::raw('MONTHNAME(created_at) as month, SUM(total_amount) as total'))
            ->groupBy('month')
            ->orderBy('created_at') 
            ->pluck('total', 'month')
            ->all();

     
        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $data = [];

        foreach ($labels as $label) {
            $data[] = $sales[$label] ?? 0;
        }

        return response()->json(array('data' => $data, 'labels' => $labels));
    }
}
