<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    public function index(){
        $my_products = Product::where('creator_id', Auth::id())->get();
        $my_revenue = ProductOrder::where('creator_id', Auth::id())->where('is_paid', "success")->sum('total_price');
        $total_order_success = ProductOrder::where('creator_id', Auth::id())->where('is_paid', "success")->get();

        return view('creator.dashboard', [
            'my_products' => $my_products,
            'my_revenue' => $my_revenue,
            'total_order_success' => $total_order_success,
        ]);
    }
}
