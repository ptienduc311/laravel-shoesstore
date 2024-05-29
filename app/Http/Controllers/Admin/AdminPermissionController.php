<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Http\Request;

class AdminPermissionController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['mod_active' => 'permission']);
            return $next($request);
        });
    }
    function add()
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });

        // dd($permissions);
        return view('admin.permission.add', compact('permissions'));
    }
    function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|max:255',
                'slug' => 'required',
            ],
            [
                'name.required' => 'Tên quyền không được để trống',
                'name.max' => 'Tên quyền không được quá 255 ký tự',
                'slug.required' => 'Slug quyền không được để trống',
            ]
        );

        #Insert db
        Permission::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description')
        ]);
        return redirect()->route('permission.add')->with('status', 'Bạn đã thêm quyền thành công');
    }
    function edit($id)
    {
        $permission = Permission::find($id);
        return view('admin.permission.edit', compact('permission'));
    }
    function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required',
        ]);
        Permission::where('id', $id)->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description')
        ]);
        return redirect()->route('permission.add')->with('status', 'Đã cập nhật thành công');
    }
    function delete($id)
    {
        Permission::find($id)->delete();
        return redirect()->route('permission.add')->with('status', 'Đã xóa thành công');
    }
}
