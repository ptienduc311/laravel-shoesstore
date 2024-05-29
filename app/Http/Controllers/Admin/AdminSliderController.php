<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Image;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminSliderController extends Controller
{
    function __construct()
    {
        $this->middleware(function($request, $next){
            session(['mod_active'=>'slider']);
            return $next($request);
        });
    }

    function list()
    {
        $sliders = Slider::all();
        return view('admin.slider.list', compact('sliders'));
    }
    function add()
    {
        $options = ['' => '--- Chọn trạng thái --- ', 'active' => 'Công khai', 'inactive' => 'Không công khai'];
        return view('admin.slider.add', compact('options'));
    }
    function store(Request $request)
    {
        $key = '';

        $request->validate(
            [
                // 'title' => 'required|string|max:255',
                // 'url' => 'required',
                'display_order' => 'required|numeric|min:0',
                'status' => 'required',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'numeric' => ':attribute phải là số',
                'min' => ':attribute có độ dài tối thiểu :min ký tự',
                'image' => ':attribute được chọn không phải dạng ảnh',
                'mimes' => ':attribute phải thuộc các loại sau jpg,png,jpeg,gif,svg'
            ],
            [
                // 'title' => "Tiêu đề",
                // 'url' => "Đường dẫn (link)",
                'display_order' => "Thứ tự",
                'status' => "Trạng thái",
                'image' => "Hình ảnh"
            ]
        );
        // dd($request->all());
        if ($request->hasFile('image')) {
            $image = $request->image;
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
        }
        $image_id = $key->id;
        Slider::create([
            'image_id' => $image_id,
            'title' => $request->input('title'),
            'url' => $request->input('link'),
            'display_order' => $request->input('display_order'),
            'status' => $request->input('status'),
            'created_by'=>Auth::user()->name,
        ]);
        return redirect('admin/slider')->with('status', 'Đã thêm mới thành công');
    }
    function edit($id)
    {
        $slider = Slider::find($id);
        $image =  $slider->image;
        $options = ['' => '--- Chọn trạng thái --- ', 'active' => 'Công khai', 'inactive' => 'Không công khai'];

        return view('admin.slider.edit', compact('slider', 'image', 'options'));
    }
    function update(Request $request, $id)
    {
        $key = '';
        $slider = Slider::find($id);
        $image =  $slider->image;
        $image_id = $image->id;
        $request->validate(
            [
                // 'title' => 'required|string|max:255',
                // 'url' => 'required',
                'display_order' => 'required|numeric|min:0',
                'status' => 'required',
                'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'numeric' => ':attribute phải là số',
                'min' => ':attribute có độ dài tối thiểu :min ký tự',
                'image' => ':attribute được chọn không phải dạng ảnh',
                'mimes' => ':attribute phải thuộc các loại sau jpg,png,jpeg,gif,svg'
            ],
            [
                // 'title' => "Tiêu đề",
                // 'url' => "Đường dẫn (link)",
                'display_order' => "Thứ tự",
                'status' => "Trạng thái",
                'image' => "Hình ảnh"
            ]
        );
        if ($request->hasFile('image')) {
            if (file_exists($image->src)) {
                unlink($image->src);
                $slider->update([
                    'image_id' => NULL,
                ]);
                Image::find($image->id)->delete();
            }
            $image = $request->image;
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
            $image_id = $key->id;
        }   
        $slider->update([
            'image_id' => $image_id,
            'title' => $request->input('title'),
            'url' => $request->input('link'),
            'display_order' => $request->input('display_order'),
            'status' => $request->input('status'),
            'created_by'=>Auth::user()->name,
        ]);
        return redirect('admin/slider')->with('status', 'Đã cập nhật thành công');
    }
    function delete($id)
    {
        $slider = Slider::find($id);
        $slider->delete();
        $image =  $slider->image;
        unlink($image->src);
        $image_id = $image->id;
        Image::find($image_id)->delete();
        return redirect('admin/slider')->with('status', 'Đã xóa thành công');
    }
}
