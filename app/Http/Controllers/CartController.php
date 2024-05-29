<?php

namespace App\Http\Controllers;

use App\Product;
use App\Size;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    function show()
    {
        // return Cart::content();
        return view('themes.cart.show');
    }

    function add(Request $request, $id)
    {
        $request->validate(
            [
                'size' => 'required'
            ],
            [
                'required' => 'Bạn chưa chọn :attribute giày',
            ],
            [
                'size' => "size"
            ]
        );
        $product = Product::find($id);
        $image_url = $product->images[0]->src;
        $size = Size::where('id', $request->size)->value('name');
        Cart::add([
            'id' => $id,
            'name' => $product->name,
            'qty' => $request->quantity,
            'price' => $product->price,
            'options' => ['code' => $product->code, 'size' => $size, 'image_url' => $image_url, 'slug' => $product->slug, 'initial' => $product->initial]
        ]);
        return redirect('cart');
    }
    function update(Request $request)
    {
        // dd($request);
        $data = $request->get('qty');
        foreach ($data as $k => $v) {
            Cart::update($k, $v);
        }
        return redirect('cart');
    }

    function remove($rowId)
    {
        Cart::remove($rowId);
        return redirect('cart');
    }

    function destroy()
    {
        Cart::destroy();
        return redirect('cart');
    }
}
