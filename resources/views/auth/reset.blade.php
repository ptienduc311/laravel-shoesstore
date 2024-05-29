@extends('layouts.auth')

@section('title', 'Quên mật khẩu')
@section('content')
    <div class="container" id="container">
        @if (session('success'))
            <script>
                Swal.fire({
                    position: "top-right",
                    icon: "success",
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 3000
                });
                setTimeout(function() {
                    window.location.href = "{{route('home')}}";
                }, 3000);
            </script>
        @endif
        <a class="btn-home icon" href="{{ route('home') }}"><i class="fa-solid fa-house"></i></a>
        <div class="form-container sign-in">
            <form method="POST" action="{{ route('password.email', $reset_token) }}" id="forgot-password-form">
                @csrf
                <h1>Bạn quên mật khẩu?</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>Nhập email của bạn để đặt lại mật khẩu</span>
                <input type="email" name="email" placeholder="Email" id="emailInput" autofocus>
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
                <button id="confirm-btn" name="btn-confirm" type="submit">Xác nhận</button>
            </form>
        </div>
        <div class="toggle-container" id="toggleContainer">
            <div class="toggle">
                <div class="toggle-panel toggle-right" id="toggleLeft">
                    <h1>Chào bạn!</h1>
                    <p>Chỉ còn vài bước nữa thôi!</p>
                    <p>Hãy trở lại và cùng tận hưởng</p>
                </div>
                <div class="loading-box toggle-right active-hidden" id="loadingBox">
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

