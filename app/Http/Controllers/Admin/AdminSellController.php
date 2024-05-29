<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Customer;
use App\Order;
use App\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminSellController extends Controller
{
    function __construct()
    {
        $this->middleware(function($request, $next){
            session(['mod_active'=>'sell']);
            return $next($request);
        });
    }

    function index()
    {
        $orders = Order::all();
        $key_all = Order::count();
        $key_delivered = Order::where('status', 'delivered')->count();
        $key_canceled = Order::where('status', 'canceled')->count();
        $key_other = Order::whereNotIn('status', ['delivered', 'canceled'])->count();
        return view('admin.sell.index', compact('orders', 'key_all', 'key_delivered', 'key_canceled', 'key_other'));
    }
    function customer()
    {
        $customers = Customer::all();
        return view('admin.sell.customer', compact('customers'));
    }
    function detailOrder($id)
    {
        $customer_id = Order::where('id', $id)->value('customer_id');

        $customer = Customer::find($customer_id);
        $order = Order::find($id);
        $order_items = OrderItem::where('order_id', $id)->get();
        return view('admin.sell.detail', compact('customer', 'order', 'order_items'));
    }
    function updateStatus(Request $request, $id){

        $status = $request->input('select-status');
        Order::where('id', $id)->update(['status' => $status]);
        return redirect()->back();
    }

    function printBill($id){
        $customer_id = Order::where('id', $id)->value('customer_id');

        $customer = Customer::find($customer_id);
        $order = Order::find($id);
        $order_items = OrderItem::where('order_id', $id)->get();
        return view('admin.sell.printBill', compact('customer', 'order', 'order_items'));
    }
}
