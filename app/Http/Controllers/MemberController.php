<?php

namespace App\Http\Controllers;

use App\Member;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    function index()
    {
        $user =  Auth::user();
        $id = $user->id;
        $member = Member::where('user_id', $id)->first();
        $createdAt = Carbon::parse($user->created_at)->format('d/m/Y');
        return view('themes.member.index', compact('user', 'createdAt', 'member'));
    }
    public function update(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        if ($request->input('action') === 'update_info') {
            $member = Member::where('user_id', $id)->first();

            if ($member) {
                $member->update([
                    'fullname' => $request->input('fullname'),
                    'phone' => $request->input('phone_number'),
                    'address' => $request->input('address'),
                ]);
            } else {
                Member::create([
                    'fullname' => $request->input('fullname'),
                    'phone' => $request->input('phone_number'),
                    'address' => $request->input('address'),
                    'user_id' => $id
                ]);
            }
            return redirect()->back()->with('success', 'Thông tin đã được cập nhật');
        }

        if ($request->input('action') === 'change_password') {
            $request->validate(
                [
                    'password_current' => [
                        'required',
                        function ($attribute, $value, $fail) use ($user) {
                            if (!Hash::check($value, $user->password)) {
                                $fail('Mật khẩu hiện tại không đúng');
                            }
                        },
                    ],
                    'password_new' => 'required|min:8|confirmed',
                ],
                [
                    'password_current.required' => 'Mật khẩu hiện tại không được để trống',
                    'password_new.required' => 'Mật khẩu mới không được để trống',
                    'password_new.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự',
                    'password_new.confirmed' => 'Mật khẩu mới không khớp',
                ]
            );

            $user->password = Hash::make($request->input('password_new'));
            $user->save();

            return redirect()->back()->with('success', 'Mật khẩu đã được thay đổi');
        }

        return redirect()->back()->with('error', 'Hành động không hợp lệ');
    }
}
