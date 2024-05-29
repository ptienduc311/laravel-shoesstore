@extends('layouts.app')

@section('title', 'Thanh toán')
@section('content')
    <div id="main-content-wp" class="checkout-page">
        @if (session('success'))
            <script>
                alert('{{ session('success') }}');
            </script>
        @endif
        <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a class="path_active" href="" title="">Thanh toán</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="wrapper" class="wp-inner clearfix">
            {!! Form::open(['route' => 'rqCheckout']) !!}
            @csrf
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <div class="section-detail">
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            {!! Form::label('fullname', 'Họ tên') !!}
                            {!! Form::text('fullname', '', ['id' => 'fullname', 'class'=>'form-control']) !!}
                            @error('fullname')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-col fl-right">
                            {!! Form::label('email', 'Email') !!}
                            {!! Form::email('email', '', ['id' => 'email', 'class'=>'form-control']) !!}
                            @error('email')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            {!! Form::label('address', 'Địa chỉ') !!}
                            {!! Form::text('address', '', ['id' => 'address', 'class'=>'form-control']) !!}
                            @error('address')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-col fl-right">
                            {!! Form::label('phone', 'Số điện thoại') !!}
                            {!! Form::text('phone', '', ['id' => 'phone', 'class'=>'form-control']) !!}
                            @error('phone')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            {!! Form::label('notes', 'Ghi chú') !!}
                            {!! Form::textarea('note', '', ['id' => 'notes', 'class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <div class="section-detail">
                    @if (Cart::count() == 0)
                        <div class="checkout_empty">
                            <p class="text_empty">Chưa có sản phẩm nào</p>
                            <p class="checkout_buy">Nhấn vào <a href="{{ route('list') }}">đây</a> để mua hàng</p>
                        </div>
                    @else
                        <table class="shop-table">
                            <thead>
                                <tr>
                                    <td>Sản phẩm</td>
                                    <td>Tổng</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Cart::content() as $item)
                                    <tr class="cart-item">
                                        <td class="product-name">
                                            <div id="cart_checkout">
                                                <div class="img_product_checkout">
                                                    <a href="{{ route('detail', $item->options->slug) }}"
                                                        class="img-container">
                                                        <img src="{{ asset($item->options->image_url) }}"
                                                            alt="Ảnh {{ $item->name }}">
                                                    </a>
                                                </div>
                                                <div class="info_product_checkout">
                                                    <a href="{{ route('detail', $item->options->slug) }}">
                                                        <p class="product_name">{{ $item->name }}<strong
                                                                class="product-quantity">x
                                                                <b style="color:#ff1900;">{{ $item->qty }}</b></strong>
                                                        </p>
                                                    </a>
                                                    <p class="product_price">{{ number_format($item->price) }}đ <span
                                                            class="product_initial">{{ number_format($item->options->initial) }}đ</span>
                                                    </p>
                                                    <p class="size">Size: <span>{{ $item->options->size }}</span></p>
                                                </div>
                                            </div>

                                        </td>
                                        <td class="product-total">{{ number_format($item->total) }}đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="order-total">
                                    <td>Tổng đơn hàng:</td>
                                    <td><strong class="total-price"
                                            style="text-transform: lowercase;"><?php echo Cart::total(); ?>đ</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    @endif
                    <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            <li>
                                {!! Form::radio('payment', 'Online', 'checked', ['id' => 'online-payment']) !!}
                                {!! Form::label('online-payment', 'Thanh toán online') !!}
                            </li>
                            <li>
                                {!! Form::radio('payment', 'COD', '', ['id' => 'payment-home']) !!}
                                {!! Form::label('payment-home', 'Thanh toán khi nhận hàng') !!}
                            </li>
                        </ul>
                    </div>
                    <div class="place-order-wp clearfix">
                        <input type="submit" name="btn-order" value="Đặt hàng">
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
