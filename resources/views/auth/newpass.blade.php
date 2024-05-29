@extends('layouts.auth')

@section('title', 'Mật khẩu mới')
@section('content')
<div class="container" id="container">
    <a class="btn-home icon" href="{{route('home')}}"><i class="fa-solid fa-house"></i></a>
    <div class="form-container sign-in">
        <form method="post" action="{{route('update.pass', $reset_token)}}">
            @csrf
            <h1>Mật khẩu mới</h1>
            <div class="social-icons">
                <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
            <span>Hãy đặt mật khẩu mới an toàn!</span>  
            <input type="password" name="password_new" placeholder="Mật khẩu mới" id="passInput">
            @error('password_new')
                <p class="error">{{ $message }}</p>
            @enderror
            <input type="password" name="password_new_confirmation" placeholder="Nhập lại mật khẩu mới" id="repassInput">
            <button id="confirm-btn" name="btn-confirm" type="submit">Xác nhận</button>
        </form>
    </div>
    <div class="toggle-container" id="toggleContainer">
        <div class="toggle">
            <div class="toggle-panel toggle-right" id="toggleLeft">
                <h1>Chào mừng trở lại!</h1>
                <p>Mật khẩu với độ bảo mật cao đem lại<br> sự an toàn cho bạn và chúng tôi</p>
                <p>Cảm ơn bạn đã luôn tin tưởng chúng tôi</p>
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