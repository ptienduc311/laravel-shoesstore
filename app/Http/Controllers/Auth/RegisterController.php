<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendMailRegister;
use App\Member;
use App\User;
use App\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    function register()
    {
        return view('auth.register');
    }
    function handle(Request $request)
    {
        $request->validate(
            [
                'username' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            [
                'required' => ':attribute không được để trống',
                'string' => ':attribute phải là chuỗi',
                'email' => ':attribute phải là email',
                'max' => ':attribute không được quá :max kí tự',
                'min' => ':attribute phải có ít nhất :min kí tự',
                'unique' => ':attribute đã tồn tại',
                'confirmed' => 'Mật khẩu xác nhận không khớp',
            ],
            [
                'username' => 'Tên đăng nhập',
                'email' => 'Email',
                'password' => 'Mật khẩu'
            ]
        );

        $urlReg = route('register');
        $email = $request->email;
        $remember_token = md5($request->name . $email . time());
        $urlActive = route('register.active', $remember_token);

        $data = [
            'username' => $request->username,
            'urlReg' => $urlReg,
            'urlActive' => $urlActive,
        ];

        $cutoffDate = Carbon::now()->subHours(24);

        User::whereNull('email_verified_at')
            ->where('created_at', '<', $cutoffDate)
            ->delete();

        User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => $remember_token
        ]);
        Mail::to($email)->send(new SendMailRegister($data));
        return redirect()->back()->with('success', 'Bạn đã đăng ký thành công. Vui lòng xác nhận tài khoản trước khi đăng nhập!!!');
    }
    function active($remember_token)
    {
        $exists = User::where('remember_token', $remember_token)->exists();
        $urlLogin = route('login');
        if ($exists) {
            $user = User::where('remember_token', $remember_token)->first();
            if (empty($user->email_verified_at)) {
                $currentDateTime = Carbon::now()->format('Y-m-d H:i:s');
                $user->email_verified_at = $currentDateTime;
                $user->save();
                UserRole::create([
                    'role_id' => 2,
                    'user_id' => $user->id
                ]);
                Member::create([
                    'user_id' => $user->id
                ]);
                return redirect()->route('login')->with('success', 'Xác nhận tài khoản thành công!!!');
            } else {
                echo "<script>
            alert('Tài khoản đã được kích hoạt trước đó');
            window.location.href = '$urlLogin';
            </script>";
            }
        } else {
            echo "<script>
            alert('Yêu cầu kích hoạt không hợp lệ. Sai mã xác nhận hoặc tài khoản đã quá thời gian xác nhận');
            window.location.href = '$urlLogin';
            </script>";
        }
    }
}
