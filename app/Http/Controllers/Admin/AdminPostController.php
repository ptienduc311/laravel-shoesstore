<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Image;
use App\PostCategory;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPostController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['mod_active' => 'post']);
            return $next($request);
        });
    }

    function list()
    {
        $posts = Post::all();
        return view('admin.post.list', compact('posts'));
    }

    function add()
    {
        $categories = PostCategory::all();
        return view('admin.post.add', compact('categories'));
    }

    function store(Request $request)
    {
        $key = '';
        $request->validate(
            [
                'title' => 'required|string|max:120',
                'content' => 'required',
                'status' => 'required',
                'category_id' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'image' => 'File được chọn không phải dạng ảnh',
                'mimes' => ':attribute phải thuộc các loại sau jpg,png,jpeg,gif,svg'
            ],
            [
                'title' => "Tiêu đề",
                'content' => 'Nội dung bài viết',
                'status' => "Trạng thái",
                'category_id' => 'Danh mục',
                'image' => 'Hình ảnh'
            ]
        );
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
                'created_by'=>Auth::user()->name
            ]);
        }
        $image_id = $key->id;
        Post::create([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'content' => $request->input('content'),
            'status' => $request->input('status'),
            'image_id' => $image_id,
            'category_id' => $request->input('category_id'),
            'created_by'=>Auth::user()->name,
        ]);
        return redirect('admin/post')->with('status', 'Đã thêm mới thành công');
    }

    function edit($id)
    {
        $post = Post::find($id);
        $categories = PostCategory::all();
        $option1 = ['' => 'Chọn danh mục'];
        $options = $option1 + $categories->pluck('category_name', 'id')->toArray();

        $image = $post->image;
        return view('admin.post.edit', compact('post', 'options', 'image'));
    }

    function update(Request $request, $id)
    {
        $post = Post::find($id);
        $image = $post->image;
        $key = '';
        $image_id = $image->id;
        $request->validate(
            [
                'title' => 'required|string|max:120',
                'content' => 'required',
                'status' => 'required',
                'category_id' => 'required',
                'image' => 'max:2048'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'title' => "Tiêu đề",
                'content' => 'Nội dung bài viết',
                'status' => "Trạng thái",
                'category_id' => 'Danh mục',
                'image' => 'Hình ảnh'
            ]
        );
        if ($request->hasFile('image')) {
            if (file_exists($image->src)) {
                unlink($image->src);
                $post->update([
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
        $post->update([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'content' => $request->input('content'),
            'status' => $request->input('status'),
            'image_id' => $image_id,
            'category_id' => $request->input('category_id'),
            'created_by'=>Auth::user()->name,
        ]);
        return redirect('admin/post')->with('status', 'Đã cập nhật thành công');
    }

    function delete($id)
    {
        $post = Post::find($id);
        $post->delete();
        $image = $post->image;
        unlink($image->src);
        Image::find($image->id)->delete();
        return redirect('admin/post')->with('status', 'Đã xóa thành công');
    }
}
