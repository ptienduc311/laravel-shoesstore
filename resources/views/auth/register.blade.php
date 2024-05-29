@extends('layouts.auth')

@section('title', 'Đăng ký')
@section('content')
    @if (session('success'))
        <script>
            alert('{{ session('success') }}');
        </script>
    @endif
    <div class="container active">
        <div class="form-container sign-up">
            <a class="btn-home-right icon" href="{{ route('home') }}"><i class="fa-solid fa-house"></i></a>
            <form method="POST" action="{{ route('register.handle') }}">
                @csrf
                <h1>Tạo tài khoản</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>hoặc sử dụng email để đăng ký</span>
                <input type="text" name="username" placeholder="Tên đăng nhập" value="{{ old('username') }}" autofocus>
                @error('username')
                    <p class="error">{{ $message }}</p>
                @enderror
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
                <input type="password" name="password" placeholder="Mật khẩu">
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
                <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu">
                <button name="btn-reg">Đăng ký</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Xin chào!</h1>
                    <p>Bạn đã là thành viên!</p><br>
                    <p>Hãy đăng nhập để cùng nhau khám phá ngay</p>
                    <a href="{{ route('login') }}"><button class="hidden" id="login">Đăng nhập</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection
