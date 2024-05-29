<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendMailRegister;
use App\Role;
use App\User;
use App\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminUserController extends Controller
{
    function __construct()
    {
        $this->middleware(function($request, $next){
            session(['mod_active'=>'user']);
            return $next($request);
        });
    }

    function list(Request $request)
    {
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
                $users = User::onlyTrashed()->where('name', 'like', "%{$keyword}%")->orWhere('email', 'like', "%{$keyword}%")->paginate(10);
            } else {
                $users = User::onlyTrashed()->paginate(10);
            }
        } else {
            if ($keyword) {
                $users = User::where('name', 'like', "%{$keyword}%")->paginate(10);
            } else {
                $users = User::paginate(10);
            }
        }
        $count_user_active = User::count();
        $count_user_trash = User::onlyTrashed()->count();
        $count = [$count_user_active, $count_user_trash];
        return view('admin.user.list', compact('users', 'count', 'list_act'));
    }
    function action(Request $request)
    {
        $list_check = $request->input('list_check');
        if ($list_check) {
            foreach ($list_check as $k => $id) {
                if (Auth::id() == $id) {
                    unset($list_check[$k]);
                }
            }
            if (!empty($list_check)) {
                $act = $request->input('act');
                if ($act) {
                    if ($act == 'delete') {
                        User::destroy($list_check);
                        return redirect('admin/user')->with('status', 'Bạn đã xóa thành công');
                    }
                    if ($act == 'restore') {
                        User::withTrashed()
                            ->whereIn('id', $list_check)
                            ->restore();
                        return redirect('admin/user')->with('status', 'Bạn đã khôi phục thành công');
                    }
                    if ($act == 'forceDelete') {
                        User::withTrashed()
                            ->whereIn('id', $list_check)
                            ->forceDelete();
                        return redirect('admin/user')->with('status', 'Bạn đã xóa người dùng ra khỏi hệ thống');
                    }
                    return redirect('admin/user')->with('danger', 'Vui lòng chọn một chức năng!');
                }
            }
            return redirect('admin/user')->with('danger', 'Bạn không thể thao tác trên tài khoản của bạn');
        } else {
            return redirect('admin/user')->with('danger', 'Bạn cần chọn phần tử để thực thi');
        }
    }
    function add()
    {
        $roles = Role::all();
        return view('admin.user.add', compact('roles'));
    }
    function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed'
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'confirmed' => 'Xác nhận mật khẩu không thành công',
                'email' => 'Địa chỉ email không hợp lệ',
                'unique' => ':attribute đã tồn tại',
            ],
            [
                'name' => 'Tên người dùng',
                'email' => 'Email',
                'password' => 'Mật khẩu'
            ]
        );

        $role = $request->role;
        if ($role == "Member") {
            $urlReg = route('register');
            $email = $request->email;
            $remember_token = md5($request->name . time());
            $urlActive = route('register.active', $remember_token);

            $data = [
                'username' => $request->name,
                'urlReg' => $urlReg,
                'urlActive' => $urlActive,
            ];

            $cutoffDate = Carbon::now()->subHours(24);

            User::whereNull('email_verified_at')
                ->where('created_at', '<', $cutoffDate)
                ->delete();

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'remember_token' => $remember_token
            ]);
            Mail::to($email)->send(new SendMailRegister($data));
            return redirect()->back()->with('status', 'Đã thêm thành viên thành công<br>Đã gửi email xác nhận đến khác hàng');
        } else {
            $timestamp = Carbon::now()->format('Y-m-d H:i:s');
            $user = User::create([
                'name' => $request->input(['name']),
                'email' => $request->input(['email']),
                'email_verified_at' => $timestamp,
                'password' => Hash::make($request->input(['password'])),
            ]);
            UserRole::create([
                'role_id' => 1,
                'user_id' => $user->id
            ]);
            return redirect()->back()->with('status', 'Đã thêm thành viên thành công');
        }
    }

    function edit(User $user)
    {
        $roles = Role::all();
        $userRoleIds = $user->roles->pluck('id')->toArray();
        return view("admin.user.edit", compact('user', 'roles', 'userRoleIds'));
    }

    function update(Request $request, User $user)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'password' => 'required|string|min:8|confirmed'
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'confirmed' => 'Xác nhận mật khẩu không thành công',
                'string' => ':attribute phải là chuỗi'
            ],
            [
                'name' => 'Tên người dùng',
                'password' => 'Mật khẩu'
            ]
        );
        $user->update([
            'name' => $request->input('name'),
            'password' => Hash::make($request->input('password')),
        ]);
        $roles = $request->input('roles');
        $pivotData = array_fill(0, count($roles), ['created_at' => now(), 'updated_at' => now()]);
        $syncData = array_combine($roles, $pivotData);

        $user->roles()->sync($syncData);
        return redirect('admin/user')->with('status', 'Đã cập nhật thành công');
    }

    function delete(User $user)
    {
        if (Auth::id() != $user->id) {
            $user->delete();
            return redirect('admin/user')->with('status', 'Đã xóa thành viên thành công');
        } else {
            return redirect('admin/user')->with('danger', 'Bạn không thể tự xóa mình ra khỏi hệ thống');
        }
    }
}
