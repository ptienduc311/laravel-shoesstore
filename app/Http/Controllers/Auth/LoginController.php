<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendMailResetPassword;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

// use Illuminate\Support\Facades\Password;

class LoginController extends Controller
{
    function login()
    {
        return view('auth.login');
    }
    function handle(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'exists:users,email',
                'password' => 'required|string|min:8',
            ],
            [
                'email.exists' => 'Email không tồn tại trong hệ thống.',
                'password.required' => 'Vui lòng nhập mật khẩu của bạn.',
                'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('email', $request->email)->first();
        if ($user && is_null($user->email_verified_at)) {
            return redirect()->back()->withErrors(['account' => 'Tài khoản chưa được xác nhận.<br>Vui lòng kiểm tra email của bạn.'])->withInput();
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->roles->contains('name', 'Member')) {
                return redirect()->route('home');
            } else {
                return redirect()->intended('dashboard');
            }
        } else {
            return redirect()->back()->withErrors(['password' => 'Mật khẩu không đúng.'])->withInput();
        }
    }


    function reset()
    {
        $currentTime = Carbon::now()->toDateTimeString();;
        $randomBytes = random_bytes(16);
        $reset_token = hash('sha256', $currentTime . $randomBytes);

        return view('auth.reset', compact('reset_token'));
    }

    public function sendResetLinkEmail(Request $request, $reset_token)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users,email'
            ],
            [
                'email.required' => 'Vui lòng không để trống',
                'email.email' => 'Vui lòng nhập địa chỉ email hợp lệ',
                'email.exists' => 'Email chưa được đăng ký'
            ]
        );

        $user = User::where('email', $request->email)->first();

        $email = $request->email;
        $urlActive = route('new.pass', $reset_token);
        $username = $user->name;


        $user->update(['reset_token' => $reset_token]);

        $data = [
            'username' => $username,
            'urlActive' => $urlActive,
        ];

        Mail::to($email)->send(new SendMailResetPassword($data));
        return redirect()->back()->with('success', 'Đã gửi mã khôi phục đến email của bạn');
    }

    function newPass($reset_token)
    {
        return view('auth.newpass', compact('reset_token'));
    }

    function updatePass(Request $request, $reset_token)
    {
        $exists = User::where('reset_token', $reset_token)->exists();
        $urlReset = route('reset.pass');
        if ($exists) {
            $request->validate(
                [
                    'password_new' => ['required', 'string', 'min:8', 'confirmed'],
                ],
                [
                    'required' => ':attribute không được để trống',
                    'string' => ':attribute phải là chuỗi',
                    'min' => ':attribute phải có ít nhất :min kí tự',
                    'confirmed' => 'Mật khẩu xác nhận không khớp',
                ],
                [
                    'password_new' => 'Mật khẩu'
                ]
            );

            $user = User::where('reset_token', $reset_token)->first();
            $user->password = Hash::make($request->password_new);
            $user->save();
            return redirect()->route('login')->with('success', 'Đã thay đổi mật khẩu thành công');
        } else {
            echo "<script>
            alert('Yêu cầu khôi phục không hợp lệ. Vui lòng kiểm tra lại email hoặc nhập lại email của bạn');
            window.location.href = '$urlReset';
            </script>";
        }
    }

    public function logout()
    {
        session()->forget('mod_active');
        Auth::logout();
        return redirect()->route('login');
    }
}
