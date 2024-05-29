<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Page;
use GuzzleHttp\Promise\AggregateException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class AdminPageController extends Controller
{
    function __construct()
    {
        $this->middleware(function($request, $next){
            session(['mod_active'=>'page']);
            return $next($request);
        });
    }

    function list()
    {
        $pages = Page::all();
        return view('admin.page.list', compact('pages'));
    }

    function add()
    {
        return view('admin.page.add');
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|max:120',
                'content' => 'required',
                'status' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'title' => "Tiêu đề",
                'content' => 'Nội dung trang',
                'status' => "Trạng thái"
            ]
        );
        Page::create(
            [
                'title' => $request->input('title'),
                'slug' => Str::slug($request->input('title')),
                'content' => $request->input('content'),
                'status' => $request->input('status'),
                'created_by'=>Auth::user()->name,
            ]
        );
        return redirect('admin/page')->with('status', 'Đã thêm mới thành công');
    }

    function edit($id)
    {
        $page = Page::find($id);
        return view('admin.page.edit', compact('page'));
    }

    function update(Request $request, $id)
    {
        Page::find($id)->update([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'content' => $request->input('content'),
            'status' => $request->input('status'),
            'created_by'=>Auth::user()->name,
        ]);
        return redirect('admin/page')->with('status', 'Cập nhật thành công!');
    }

    function delete($id)
    {
        Page::find($id)->delete();
        return redirect('admin/page')->with('status', 'Đã xóa thành công!');
    }
}
