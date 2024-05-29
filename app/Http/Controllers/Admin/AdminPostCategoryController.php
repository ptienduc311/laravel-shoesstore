<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PostCategory;
use Illuminate\Support\Facades\Auth;

class AdminPostCategoryController extends Controller
{
    function list()
    {
        $categories = PostCategory::where('parent_id', 0)
            ->with(['children'])
            ->get();
        $name_cat = PostCategory::all();
        return view('admin.post.listCat', compact('categories', 'name_cat'));
    }

    function add()
    {
        $categories = PostCategory::where('parent_id', 0)
            ->whereRaw('id <> ?', [1])
            ->get();
        $option1 = ['0' => 'Danh mục cha'];
        $options = $option1 + $categories->pluck('category_name', 'id')->toArray();
        // return $options;
        return view('admin.post.addCat', compact('options'));
    }

    function store(Request $request)
    {
        $category_desc = $request->input('category_desc');
        // return $request;
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
        PostCategory::create(
            [
                'category_name' => $request->input('category_name'),
                'category_desc' => $category_desc,
                'parent_id' => $request->input('parent_id'),
                'created_by'=>Auth::user()->name,
            ]
        );
        return redirect('admin/post/cat')->with('status', 'Đã thêm mới thành công');
    }

    function edit($id)
    {
        $postCat = PostCategory::find($id);

        $categories = PostCategory::where('parent_id', 0)
            ->whereRaw('id <> ?', [1])
            ->get();
        $option1 = ['0' => 'Danh mục cha'];
        $options = $option1 + $categories->pluck('category_name', 'id')->toArray();
        // return $options;
        return view('admin.post.editCat', compact('postCat', 'options'));
    }

    function update(Request $request, $id)
    {
        $category_desc = $request->input('category_desc');
        // return $request;
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

        PostCategory::find($id)->update([
            'category_name' => $request->input('category_name'),
            'category_desc' => $category_desc,
            'parent_id' => $request->input('parent_id'),
            'created_by'=>Auth::user()->name,
        ]);
        return redirect('admin/post/cat')->with('status', 'Đã cập nhật thành công');
    }

    function delete($id)
    {
        $category = PostCategory::findOrFail($id);
        if ($category->parent_id == 0) {
            $children = PostCategory::where('parent_id', $id)->get();
            foreach ($children as $child) {
                $child->parent_id = 1;
                $child->save();
            }
            $category->delete();
            return redirect('admin/post/cat')->with('status', 'Đã xóa thành công');
        } else {
            $category->delete();
            return redirect('admin/post/cat')->with('status', 'Đã xóa thành công');
        }
    }
}
