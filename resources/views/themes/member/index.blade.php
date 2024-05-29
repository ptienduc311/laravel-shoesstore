@extends('layouts.app')

@section('title', 'Thành viên')
@section('content')
    <div id="main-content-wp-member" class="home-page clearfix">
        <div class="wp-inner">
            <div class="main-content fl-right">
                @if (session('success'))
                    <div class="alert alert-success"
                        style="padding: 10px; border-radius: 5px; margin-bottom: 10px; width: 97%;">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="block-welcom">
                    <div class="welcom-logo">
                        <img src="{{ asset('themes/images/avatar.png') }}" alt="">
                    </div>
                    <div class="welcom-member">
                        <p class="text-welcom-1">Xin chào</p>
                        <p class="text-welcom-2">{{ Auth::user()->name }}
                        <p>
                        <div class="welcom-info">
                            <div class="item-contentWelcome">
                                <p>Ngày tham gia</p>
                                <div class="cp-icon">
                                    <i class="fa-regular fa-calendar-days"></i>
                                </div>
                                <p>{{ $createdAt }}</p>
                            </div>
                            <div class="item-contentWelcome">
                                <p>Hạng thành viên</p>
                                <div class="cp-icon">
                                    <i class="fa-solid fa-ranking-star"></i>
                                </div>
                                <p>ShoesNull</p>
                            </div>
                            <div class="item-contentWelcome">
                                <p>Tổng đơn mua</p>
                                <div class="cp-icon">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </div>
                                <p><span>17</span> đơn hàng</p>
                            </div>
                        </div>
                    </div>
                    <div id="info-member">
                        <h3>Thông tin khách hàng</h3>
                        <form action="{{ route('member.update') }}" method="post" id="update-info-form">
                            @csrf
                            <input type="hidden" name="action" value="update_info">
                            <div class="form-group">
                                <label for="fullname">Họ và tên:</label>
                                {{-- @if (!empty($member->fullname)) --}}
                                    <input type="text" name="fullname" id="fullname" value="{{ $member->fullname }}"
                                        placeholder="Nhập họ tên">
                                {{-- @else
                                    <input type="text" name="fullname" id="fullname" placeholder="Nhập họ tên">
                                @endif --}}
                            </div>
                            <div class="form-group">
                                <label for="username">Tên đăng nhập:</label>
                                <input type="text" name="username" id="username" readonly="readonly"
                                    value="{{ Auth::user()->name }}" style="background-color: #d3c4c4;">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" name="email" id="email" value="{{ Auth::user()->email }}"
                                    readonly="readonly" style="background-color: #d3c4c4;">
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Số điện thoại:</label>
                                {{-- @if (!empty($member->phone)) --}}
                                    <input type="text" name="phone_number" id="phone_number" value="{{ $member->phone }}"
                                        maxlength="10" placeholder="Nhập số điện thoại">
                                {{-- @else
                                    <input type="text" name="phone_number" id="phone_number" maxlength="10"
                                        placeholder="Nhập số điện thoại">
                                @endif --}}

                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ:</label>
                                {{-- @if (!empty($member->address)) --}}
                                    <input type="text" name="address" id="address" value="{{ $member->address }}"
                                        placeholder="Nhập địa chỉ">
                                {{-- @else
                                    <input type="text" name="address" id="address" placeholder="Nhập địa chỉ">
                                @endif --}}

                            </div>
                            <input class="button-member" type="submit" value="Cập nhật thông tin" name="btn-update">
                        </form>
                    </div>

                    <div id="info-member">
                        <h3>Thay đổi mật khẩu</h3>
                        <form action="{{ route('member.update') }}" method="post" id="change-password-form">
                            @csrf
                            <input type="hidden" name="action" value="change_password">
                            <div class="form-group">
                                <label for="password-current">Mật khẩu hiện tại:</label>
                                <input type="password" name="password_current" id="password-current" value=""
                                    placeholder="Nhập mật khẩu hiện tại">
                            </div>
                            @if ($errors->has('password_current'))
                                <p class="error">{{ $errors->first('password_current') }}</p>
                            @endif
                            <div class="form-group">
                                <label for="password-new">Mật khẩu mới:</label>
                                <input type="password" name="password_new" id="password-new" value=""
                                    placeholder="Nhập mật khẩu mới">
                            </div>
                            @error('password_new')
                                <p class="error">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label for="password-confirm">Nhập lại mật khẩu:</label>
                                <input type="password" name="password_new_confirmation" id="password-confirm"
                                    value="" placeholder="Nhập lại mật khẩu mới">
                            </div>


                            <input class="button-member" type="submit" value="Xác nhận" name="btn-reset">
                        </form>
                    </div>
                </div>
                </form>
            </div>

        </div>
        <div class="sidebar fl-left">
            <div class="block-menu">
                <div class="block-menu-item button-home active">
                    <div class="item-menu">
                        <div class="box-icon">
                            <i class="fa-solid fa-house-user"></i>
                        </div>
                        <p>Trang chủ</p>
                    </div>
                </div>
                <div class="block-menu-item button-historty">
                    <div class="item-menu">
                        <div class="box-icon">
                            <i class="fa-solid fa-bag-shopping"></i>
                        </div>
                        <p>Lịch sử mua hàng</p>
                    </div>
                </div>
                <div class="block-menu-item button-guarantee">
                    <div class="item-menu">
                        <div class="box-icon">
                            <i class="fa-solid fa-shield"></i>
                        </div>
                        <p>Tra cứu bảo hành</p>
                    </div>
                </div>
                <div class="block-menu-item button-promotion">
                    <div class="item-menu">
                        <div class="box-icon">
                            <i class="fa-solid fa-gift"></i>
                        </div>
                        <p>Ưu đãi của bạn</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
