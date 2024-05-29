<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProductCategoryController extends Controller
{
    function list()
    {
        $categories = ProductCategory::all();
        return view('admin.product.listCat', compact('categories'));
    }
    function add()
    {
        $categories = ProductCategory::where('parent_id', 0)->get();
        $option1 = ['0' => 'Danh mục cha'];

        $options = $option1 + $categories->pluck('category_name', 'id')->toArray();
        return view('admin.product.addCat', compact('options'));
    }
    function store(Request $request)
    {
        $category_desc = $request->input('category_desc');
        $request->validate(
            [
                'category_name' => 'required|string|max:120'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'category_name' => "Tên danh mục",
            ]
        );

        if (empty($category_desc)) {
            $category_desc = NULL;
        }
        ProductCategory::create(
            [
                'category_name' => $request->input('category_name'),
                'category_slug' => Str::slug($request->input('category_name')),
                'category_desc' => $category_desc,
                'parent_id' => $request->input('parent_id'),
                'created_by'=>Auth::user()->name,
            ]
        );
        return redirect('admin/product/cat')->with('status', 'Đã thêm mới thành công');
    }
    function edit($id)
    {
        $productCat = ProductCategory::find($id);
        $categories = ProductCategory::where('parent_id', 0)->whereRaw('id <> ?', [$id])
            ->get();
        $option1 = ['Danh mục cha'];
        $options = $option1 + $categories->pluck('category_name', 'id')->toArray();
        // return $options;
        return view('admin.product.editCat', compact('productCat', 'options'));
    }
    function update(Request $request, $id)
    {
        $category_desc = $request->input('category_desc');
        $request->validate(
            [
                'category_name' => 'required|string|max:120'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'category_name' => "Tên danh mục",
            ]
        );

        if (empty($category_desc)) {
            $category_desc = NULL;
        }
        ProductCategory::find($id)->update(
            [
                'category_name' => $request->input('category_name'),
                'category_slug' => Str::slug($request->input('category_name')),
                'category_desc' => $category_desc,
                'parent_id' => $request->input('parent_id'),
                'created_by'=>Auth::user()->name,
            ]
        );
        return redirect('admin/product/cat')->with('status', 'Đã cập nhật thành công');
    }
    function delete($id)
    {
        ProductCategory::find($id)->delete();
        return redirect('admin/product/cat')->with('status', 'Đã xóa thành công');
    }
}
