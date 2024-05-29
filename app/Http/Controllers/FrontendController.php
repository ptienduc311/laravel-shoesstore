<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Mail\SendMailCheckout;
use App\Order;
use App\OrderItem;
use App\Page;
use App\Post;
use App\PostCategory;
use App\Product;
use App\ProductCategory;
use App\Size;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    function index()
    {
        $categories = ProductCategory::all();
        $products_selling = Product::where('is_selling', 1)->where('status', '!=', 'inactive')->get();
        $products_featured = Product::where('is_featured', 1)->where('status', '!=', 'inactive')->get();
        $sliders = Slider::orderBy('display_order', 'asc')->get();
        return view('themes.home', compact('categories', 'products_selling', 'products_featured', 'sliders'));
    }
    #BLOG
    function page($slug)
    {
        $page = Page::where('slug', $slug)->first();
        $products_selling = Product::where('is_selling', 1)->where('status', '!=', 'inactive')->get();

        return view('themes.blog.page', compact('page', 'products_selling'));
    }
    function post()
    {
        $categories = ProductCategory::all();
        $products_selling = Product::where('is_selling', 1)->where('status', '!=', 'inactive')->get();

        $post_cat = PostCategory::all();
        return view('themes.blog.post', compact('post_cat', 'categories', 'products_selling'));
    }
    function postDetail($slug)
    {
        $categories = ProductCategory::all();
        $products_selling = Product::where('is_selling', 1)->where('status', '!=', 'inactive')->get();
        $post = Post::where('slug', $slug)->first();
        return view('themes.blog.postDetail', compact('categories', 'products_selling', 'post'));
    }
    #PRODUCT
    function listProduct(Request $request)
    {
        $categories = ProductCategory::all();
        $q_categories = $request->query("categories");
        $q_price = $request->query("price");
        $prices = '';
        switch ($q_price) {
            case 1:
                $prices = [0, 500000];
                break;
            case 2:
                $prices = [500000, 1000000];
                break;
            case 3:
                $prices = [1000000, 2000000];
                break;
            case 4:
                $prices = [2000000, 4000000];
                break;
            case 5:
                $prices = [4000000, 1000000000];
                break;
        }
        if (!$q_price && !$q_categories) {
            $products = Product::where('status', '!=', 'inactive')->paginate(8);
        } else if ($q_price && !$q_categories) {
            $products = Product::whereBetween('price', $prices)->where('status', '!=', 'inactive')->paginate(12);
        } else if ($q_categories && !$q_price) {
            $products = Product::where(function ($query) use ($q_categories) {
                $query->whereIn('category_id', explode(',', $q_categories))->orWhereRaw("'" . $q_categories . "'=''");
            })->where('status', '!=', 'inactive')->paginate(12);
        } else {
            $products = Product::where(function ($query) use ($q_categories) {
                $query->whereIn('category_id', explode(',', $q_categories))->orWhereRaw("'" . $q_categories . "'=''");
            })->where('status', '!=', 'inactive')->whereBetween('price', $prices)->paginate(12);
        }

        $count = $products->count();
        $total = Product::where('status', '!=', 'inactive')->count();
        return view('themes.product.list', compact('categories', 'products', 'count', 'total', 'q_categories', 'q_price'));
    }
    function detailProduct($slug)
    {
        $categories = ProductCategory::all();
        $product = Product::where('slug', $slug)->first();
        $products_same = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', '!=', 'inactive')
            ->inRandomOrder()
            ->take(8)
            ->get();
        $sizes = $product->sizes->pluck('name', 'id')->toArray();
        return view('themes.product.detail', compact('categories', 'product', 'sizes', 'products_same'));
    }
    function categoryProduct(Request $request, $name)
    {
        $categories = ProductCategory::all();
        $products_selling = Product::where('is_selling', 1)->where('status', '!=', 'inactive')->get();
        $idCat = ProductCategory::where('category_name', $name)->first(['id']);
        $nameCat = $name;

        $order = $request->query("order");
        if (!$order)
            $order = -1;
        $o_column = "";
        $o_order = "";
        switch ($order) {
            case 1:
                $o_column = "name";
                $o_order = "DESC";
                break;
            case 2:
                $o_column = "name";
                $o_order = "ASC";
                break;
            case 3:
                $o_column = "price";
                $o_order = "DESC";
                break;
            case 4:
                $o_column = "price";
                $o_order = "DESC";
                break;
            default:
                $o_column = "id";
                $o_order = "DESC";
        }
        $products = ProductCategory::where('category_slug', $name)->first()->products()->where('status', '!=', 'inactive')->orderBy($o_column, $o_order)->paginate(12);
        $count = $products->count();
        $total = Product::where('category_id', $idCat)->where('status', '!=', 'inactive')->count();
        return view('themes.product.category', compact('categories', 'products_selling', 'products', 'nameCat', 'count', 'total', 'order'));
    }

    #----Trừ số lượng-----
    private function updateProductQuantity($productId, $k)
    {
        $product = Product::find($productId);

        if ($product) {
            $product->stock_quantity -= $k;

            if ($product->stock_quantity < 0) {
                $product->stock_quantity = 0;
            }

            $product->save();
        }
    }

    #CHECKOUT
    function checkout()
    {
        return view('themes.checkout');
    }
    function rqCheckout(Request $request)
    {
        $code = time() . Str::random(10);
        $time = Carbon::now()->format('Y-m-d H:i:s');
        $currentDate = Carbon::now()->format('d-m-Y');

        $request->validate(
            [
                'fullname' => 'required|string|max:120',
                'email' => 'required|string|max:120',
                'address' => 'required|string|max:120',
                'phone' => 'required|numeric|digits:10',
            ],
            [
                'required' => ':attribute không được để trống',
                'string' => ':attribute phải là chuỗi',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'numeric' => ':attribute phải là số',
                'digits' => ':attribute phải là số có :digits chữ số',
            ],
            [
                'fullname' => 'Họ và tên',
                'email' => 'Email',
                'address' => 'Địa chỉ',
                'phone' => 'Số điện thoại',
            ]
        );

        $fullname = $request->fullname;
        $phone = $request->phone;
        $email = $request->email;
        $address = $request->address;
        $data = [
            'fullname' => $fullname,
            'code' => $code,
            'time' => $time,
            'currentDate' => $currentDate,
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
            'orders' => Cart::content(),
            'total_amout' => Cart::total()
        ];

        $customer = Customer::create([
            'fullname' => $fullname,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'note' => $request->note
        ]);

        $order = Order::create([
            'code' => $code,
            'quantity' => Cart::count(),
            'total_amout' => Cart::total(0, '', ''),
            'order_date' => $time,
            'payment' => $request->payment,
            'address' => $request->address,
            'customer_id' => $customer->id,
        ]);

        foreach (Cart::content() as $item) {
            $order_item = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'product_name' => $item->name,
                'image_url' => $item->options->image_url,
                'size' => $item->options->size,
                'quantity' => $item->qty,
                'price' => $item->price,
            ]);
            $this->updateProductQuantity($item->id, $item->qty);
        }

        Mail::to($email)->send(new SendMailCheckout($data));
        Cart::destroy();
        return redirect()->back()->with('success', 'Bạn đã đặt hàng thành công');
    }
}
