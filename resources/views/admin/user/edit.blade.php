@extends('layouts.admin')

@section('title', 'Chỉnh sửa người dùng')
@section('custom-css')
    <link href="{{ asset('admin_style/css/user/add_user.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div id="content" class="fl-right">
        <div id="card">
            @if (session('status'))
                <div class="alert alert-success">
                    {!! session('status') !!}
                </div>
            @endif
            <h2>CHỈNH SỬA NGƯỜI DÙNG</h2>
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Tên tài khoản</label>
                    <input type="text" id="name" name="name" value="{{ $user->name }}" required>
                </div>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}" readonly required>
                </div>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" id="password" name="password" value="{{ old('password') }}" required>
                </div>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="form-group">
                    <label for="password_confirmation">Xác nhận mật khẩu</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
                <div class="form-group">
                    <label for="role">Nhóm quyền</label>
                    <select id="role" multiple name="roles[]" required>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ in_array($role->id, $userRoleIds) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>                    
                </div>
                <div class="form-group">
                    <button type="submit">Cập nhật</button>
                </div>
            </form>
        </div>

    </div>
@endsection
