<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Size;
use Illuminate\Http\Request;

class AdminSizeController extends Controller
{
    //
    function add()
    {
        $sizes = Size::orderBy('name', 'asc')->get();
        return view('admin.product.size', compact( 'sizes'));
    }
    function store(Request $request)
    {
        $request->validate(
            [
                'size' => 'required|numeric|unique:sizes,name'
            ],
            [
                'size.required' => 'Trường này là bắt buộc.',
                'size.numeric' => 'Trường này phải là số.',
                'size.unique' => 'Giá trị này đã tồn tại trong cơ sở dữ liệu.',
            ]
        );
        Size::create([
            'name' => $request->input('size')
        ]);
        return redirect('admin/size/add')->with('status', 'Đã thêm mới thành công');

    }
}
