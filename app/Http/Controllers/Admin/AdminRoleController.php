<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['mod_active' => 'permission']);
            return $next($request);
        });
    }
    function index(Request $request)
    {
        // return Auth::user()->hasPermission('posts.add');
        // if(!Gate::allows('role.view')){
        //     abort(403);
        // }
        $status = $request->input('status');
        $keyword = $request->input('keyword');
        $list_act = [
            'delete' => 'Xóa tạm thời',
        ];
        if ($status == 'trash') {
            $list_act = [
                'restore' => 'Khôi phục',
                'forceDelete' => 'Xóa vĩnh viễn'
            ];
            if ($keyword) {
                $roles = Role::onlyTrashed()->where('name', 'like', "%{$keyword}%")->paginate(10);
            } else {
                $roles = Role::onlyTrashed()->paginate(10);
            }
        } else {
            if ($keyword) {
                $roles = Role::where('name', 'like', "%{$keyword}%")->orWhere('description', 'like', "%{$keyword}%")->paginate(10);
            } else {
                $roles = Role::paginate(10);
            }
        }
        $count_role_active = Role::count();
        $count_role_trash = Role::onlyTrashed()->count();
        $count = [$count_role_active, $count_role_trash];
        return view('admin.role.index', compact('roles', 'count', 'list_act'));
    }
    function action(Request $request)
    {
        $list_check = $request->input('list_check');
        if ($list_check) {
            foreach ($list_check as $k => $id) {
                if ($id == 1 || $id == 2) {
                    unset($list_check[$k]);
                }
            }
            if (!empty($list_check)) {
                $act = $request->input('act');
                if ($act) {
                    if ($act == 'delete') {
                        Role::destroy($list_check);
                        return redirect('admin/role')->with('status', 'Bạn đã xóa thành công');
                    }
                    if ($act == 'restore') {
                        Role::withTrashed()
                            ->whereIn('id', $list_check)
                            ->restore();
                        return redirect('admin/role')->with('status', 'Bạn đã khôi phục thành công');
                    }
                    if ($act == 'forceDelete') {
                        Role::withTrashed()
                            ->whereIn('id', $list_check)
                            ->forceDelete();
                        return redirect('admin/role')->with('status', 'Bạn đã xóa thành công');
                    }
                    return redirect('admin/role')->with('danger', 'Vui lòng chọn một chức năng!');
                }
            }
            return redirect('admin/role')->with('danger', 'Quyền này không thể xóa');
        } else {
            return redirect('admin/role')->with('danger', 'Bạn cần chọn phần tử để thực thi');
        }
    }
    function add()
    {
        // if(!Gate::allows('role.add')){
        //     abort(403);
        // }
        
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });
        // return $permissions;
        return view('admin.role.add', compact('permissions'));
    }

    function store(Request $request)
    {
        // return "Store role";
        $request->validate(
            [
                'name' => 'required|max:255|unique:roles,name',
                'description' => 'required',
                'permission_id' => 'required|array|min:1',
                'permission_id.*' => 'exists:permissions,id'
            ],
            [
                'name.required' => 'Tên vai trò không được để trống',
                'name.max' => 'Tên vai trò không được quá 255 ký tự',
                'name.unique' => 'Tên vai trò đã tồn tại',
                'description.required' => 'Mô tả không được để trống',
                'permission_id.required' => 'Bạn phải chọn ít nhất một quyền',
                'permission_id.min' => 'Bạn phải chọn ít nhất một quyền',
                'permission_id.*.exists' => 'Danh sách quyền không tồn tại'
            ]
        );
        #Create new role
        $role = Role::create(["name" => $request->input("name"), "description" => $request->input("description")]);

        #Attach permission for role
        $permissions = $request->input('permission_id');
        $pivotData = array_fill(0, count($permissions), ['created_at' => now(), 'updated_at' => now()]);
        $syncData = array_combine($permissions, $pivotData);

        $role->permissions()->sync($syncData);
        return  redirect()->route('role.index')->with('status', 'Đã thêm vai trò thành công');
    }
    function edit(Role $role)
    {   
        if($role->id == 2){
            return redirect('admin/role')->with('danger', 'Quyền này không được thêm vai trò quản lý');
        }
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });
        $permissionIds = $role->permissions->pluck('id')->toArray();
        return view('admin.role.edit', compact('permissions', 'role', 'permissionIds'));
    }
    function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|max:255|unique:roles,name,' . $role->id,
            'description' => 'required',
            'permission_id' => 'nullable|array',
            'permission_id.*' => 'exists:permissions,id'
        ]);
        // return $request->all();
        $role->update([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);
        $permissions = $request->input('permission_id');
        $pivotData = array_fill(0, count($permissions), ['created_at' => now(), 'updated_at' => now()]);
        $syncData = array_combine($permissions, $pivotData);

        $role->permissions()->sync($syncData);
        return redirect()->route('role.index')->with('status', 'Đã cập nhật vai trò thành công');
    }
    function delete(Role $role)
    {
        if ($role->id == 1 || $role->id == 2) {
            return redirect('admin/role')->with('danger', 'Quyền này không thể xóa');
        } else {
            $role->delete();
            return redirect()->route('role.index')->with('status', 'Đã xóa vai trò thành công');
        }
    }
}
