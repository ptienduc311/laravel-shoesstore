<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function dashboard()
    {
        $orders = Order::all();
        $product_count = Product::sum('stock_quantity');
        $key_delivered = Order::where('status', 'delivered')->count();
        $key_canceled = Order::where('status', 'canceled')->count();
        $key_processing = Order::where('status', 'processing')->count();
        return view('admin.dashboard', compact('key_delivered', 'key_canceled', 'key_processing', 'product_count', 'orders'));
    }
}
