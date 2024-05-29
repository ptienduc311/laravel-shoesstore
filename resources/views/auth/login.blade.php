@extends('layouts.auth')

@section('title', 'Đăng nhập')
@section('content')
    <div class="container">
        @if (session('success'))
            <script>
                Swal.fire({
                    position: "top-right",
                    icon: "success",
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        @endif
        <div class="form-container sign-in">
            <a class="btn-home icon" href="{{ route('home') }}"><i class="fa-solid fa-house"></i></a>
            <form action="{{ route('login.handle') }}" method="POST">
                @csrf
                <h1>Đăng nhập</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>hoặc sử dụng tài khoản của bạn</span>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email"
                    required autofocus>
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
                <input type="password" name="password" placeholder="Mật khẩu" value="">
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
                @error('account')
                    @php
                        echo "<p class='error'> $message </p>"
                    @endphp
                @enderror
                <div id="remember">
                    <input type="checkbox" id="remember-me" name="remember-me">
                    <label for="remember-me">Ghi nhớ đăng nhập</label>
                </div>
                <a href="{{ route('reset.pass') }}">Quên mật khẩu?</a>
                <button type="submit" name="btn-login">Đăng nhập</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-right">
                    <h1>Chào bạn!</h1>
                    <p>Hãy đăng ký là thành viên để tận hưởng dịch vụ của chúng tôi</p>
                    <a href="{{ route('register') }}"><button class="hidden" id="register">Đăng ký</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection
