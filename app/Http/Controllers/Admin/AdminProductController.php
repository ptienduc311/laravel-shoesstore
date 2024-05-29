<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Image;
use App\Product;
use App\ProductCategory;
use App\ProductImage;
use App\ProductSize;
use App\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['mod_active' => 'product']);
            return $next($request);
        });
    }

    function list(Request $request)
    {
        $keyword = $request->query('keyword');
        $order = $request->query("order");
        if (!$order) {
            $order = 'default';
        }
        $o_column = "";
        $o_order = "";
        switch ($order) {
            case 'active':
                $o_column = "status";
                $o_order = "active";
                break;
            case 'inactive':
                $o_column = "status";
                $o_order = "inactive";
                break;
            case 'out_of_stock':
                $o_column = "status";
                $o_order = "out_of_stock";
                break;
            case 'new':
                $o_column = "created_at";
                $o_order = "DESC";
                break;
            case 'old':
                $o_column = "created_at";
                $o_order = "ASC";
                break;
            default:
                $o_column = "id";
                $o_order = "DESC";
        }
        if ($order == 'default') {
            if ($keyword) {
                $products = Product::where('name', 'like', "%{$keyword}%")->paginate(5);
            } else {
                $products = Product::orderBy($o_column, $o_order)->paginate(5);
            }
        } else if ($order == 'old' || $order == 'new') {
            $products = Product::orderBy($o_column, $o_order)->paginate(5);
        } else {
            $products = Product::where($o_column, $o_order)->paginate(5);
        }
        $count = $products->count();
        $total = Product::all()->count();
        return view('admin.product.list', compact('products', 'count', 'total', 'order', 'keyword'));
    }
    function add()
    {
        do {
            $code = 'UNI-' . Str::random(4);
        } while (Product::where('code', $code)->exists());

        // $sizes =  Size::orderBy('name', 'asc')->get();
        $sizes =  Size::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $categories = ProductCategory::where('parent_id', 0)->get();
        $option1 = ['' => 'Danh mục cha'];
        $options = $option1 + $categories->pluck('category_name', 'id')->toArray();
        return view('admin.product.add', compact('sizes', 'options', 'code'));
    }
    function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:120',
                'initial' => 'required|numeric|min:0',
                'price' => 'required|numeric|min:0',
                'size' => 'required',
                'stock_quantity' => 'required|numeric|min:0',
                'parameter' => 'required',
                'detail' => 'required',
                'category_id' => 'required',
                'is_featured' => 'required',
                'is_selling' => 'required',
                'status' => 'required',
                'images' => 'required',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'numeric' => ':attribute phải là số',
                'min' => ':attribute có độ dài tối thiểu :min ký tự',
                'images.required' => 'Bạn chưa chọn ảnh nào.',
                'images.*.image' => 'Tệp tải lên phải là ảnh.',
                'images.*.mimes' => 'Chỉ chấp nhận các định dạng: jpeg, png, jpg, gif, svg.',
                'images.*.max' => 'Dung lượng ảnh không được vượt quá 2MB.',
            ],
            [
                'name' => "Tên sản phẩm",
                'parameter' => "Thông số sản phẩm",
                'detail' => "Chi tiết sản phẩm",
                'initial' => "Giá ban đầu",
                'price' => "Giá bán",
                'size' => "Size",
                'stock_quantity' => "Số lượng",
                'category_id' => "Danh mục",
                'is_featured' => "Sản phẩm nổi bật",
                'is_selling' => "Sản phẩm bán chạy",
                'status' => "Trạng thái",
                'images' => "Hình ảnh"
            ]
        );
        // dd($request);
        $product = Product::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'code' => $request->input('code'),
            'initial' => $request->input('initial'),
            'price' => $request->input('price'),
            'stock_quantity' => $request->input('stock_quantity'),
            'parameter' => $request->input('parameter'),
            'detail' => $request->input('detail'),
            'is_featured' => $request->input('is_featured'),
            'is_selling' => $request->input('is_selling'),
            'status' => $request->input('status'),
            'created_by'=>Auth::user()->name,
            'category_id' => $request->input('category_id'),
        ]);
        $product_id = $product->id;
        $isFirstElement = true;
        foreach ($request->images as $image) {
            $extension = $image->getClientOriginalName();
            $name = time() . "." . $extension;
            $size = $image->getSize();
            $path = $image->move('uploads/', $name);
            $src = "uploads/{$name}";
            $key = Image::create([
                'name' => $name,
                'src' => $src,
                'size' => $size,
            ]);
            ProductImage::create([
                'product_id' => $product_id,
                'image_id' => $key->id,
                'pin' => $isFirstElement ? '1' : '0',
                'created_by'=>Auth::user()->name
            ]);
            $isFirstElement = false;
        }
        foreach ($request->size as $key => $value) {
            ProductSize::create([
                'product_id' => $product_id,
                'size_id' => $value
            ]);
        }
        return redirect('admin/product')->with('status', 'Đã thêm mới thành công');
    }
    function edit($id)
    {
        $product = Product::find($id);
        $images = $product->images;
        foreach ($product->sizes as $k) {
            $key_size[] = $k->id;
        }
        $sizes =  Size::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $categories = ProductCategory::where('parent_id', 0)->get();
        $option1 = ['' => 'Danh mục cha'];
        $options = $option1 + $categories->pluck('category_name', 'id')->toArray();
        return view('admin.product.edit', compact('sizes', 'options', 'product', 'key_size', 'images'));
    }
    function update(Request $request, $id)
    {
        $product = Product::find($id);
        $images = $product->images;
        $product_images = ProductImage::where('product_id', $id)->get();
        $sizes = $request->input('size');
        $isFirstElement = true;
        $request->validate(
            [
                'name' => 'required|string|max:120',
                'initial' => 'required|numeric|min:0',
                'price' => 'required|numeric|min:0',
                'size' => 'required',
                'stock_quantity' => 'required|numeric|min:0',
                'parameter' => 'required',
                'detail' => 'required',
                'category_id' => 'required',
                'images.*' => 'mimes:jpg,png,jpeg,gif|max:5048'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'numeric' => ':attribute phải là số',
                'min' => ':attribute có độ dài tối thiểu :min ký tự',
                // 'image' => ':attribute được chọn không phải dạng ảnh',
                'mimes' => ':attribute phải thuộc các loại sau jpg,png,jpeg,gif,svg'
            ],
            [
                'name' => "Tên sản phẩm",
                'parameter' => "Thông số sản phẩm",
                'detail' => "Chi tiết sản phẩm",
                'initial' => "Giá ban đầu",
                'price' => "Giá bán",
                'size' => "Size",
                'stock_quantity' => "Số lượng",
                'category_id' => "Danh mục",
                'images' => "Hình ảnh"
            ]
        );
        $pivotData = array_fill(0, count($sizes), ['created_at' => now(), 'updated_at' => now()]);
        $syncData = array_combine($sizes, $pivotData);
        $product->sizes()->sync($syncData);
        if ($request->hasFile('images')) {
            foreach ($product_images as $key) {
                ProductImage::find($key->id)->delete();
            }
            foreach ($images as $key) {
                Image::find($key->id)->delete();
                unlink($key->src);
            }
            foreach ($request->images as $image) {
                $extension = $image->getClientOriginalName();
                $name = time() . "." . $extension;
                $size = $image->getSize();
                $path = $image->move('uploads/', $name);
                $src = "uploads/{$name}";
                $key = Image::create([
                    'name' => $name,
                    'src' => $src,
                    'size' => $size,
                    'created_by'=>Auth::user()->name
                ]);
                ProductImage::create([
                    'product_id' => $id,
                    'image_id' => $key->id,
                    'pin' => $isFirstElement ? '1' : '0'
                ]);
                $isFirstElement = false;
            }
        }
        $product->update([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'code' => $request->input('code'),
            'initial' => $request->input('initial'),
            'price' => $request->input('price'),
            'stock_quantity' => $request->input('stock_quantity'),
            'parameter' => $request->input('parameter'),
            'detail' => $request->input('detail'),
            'is_featured' => $request->input('is_featured'),
            'is_selling' => $request->input('is_selling'),
            'status' => $request->input('status'),
            'created_by'=>Auth::user()->name,
            'category_id' => $request->input('category_id'),
        ]);
        return redirect('admin/product')->with('status', 'Đã cập nhật thành công');
    }
    function delete($id)
    {
        $product = Product::find($id);
        $product_sizes = ProductSize::where('product_id', $id)->get();
        $images = $product->images;
        $product_images = ProductImage::where('product_id', $id)->get();

        foreach ($product_sizes as $key) {
            ProductSize::find($key->id)->delete();
        }
        foreach ($product_images as $key) {
            ProductImage::find($key->id)->delete();
        }
        foreach ($images as $key) {
            Image::find($key->id)->delete();
            unlink($key->src);
        }
        $product->delete();
        return redirect('admin/product')->with('status', 'Đã xóa thành công');
    }
}
