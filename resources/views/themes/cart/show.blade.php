@extends('layouts.app')

@section('title', 'Giỏ hàng')
@section('content')
    <div id="main-content-wp" class="cart-page">
        <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a class="path_active" title="">Giỏ hàng</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="wrapper" class="wp-inner">
            @if (Cart::count() == 0)
                <div class="d-flex align-items-center flex-column">
                    <div class="empty_cart">
                        <img src="{{ asset('themes/images/empty_cart.png') }}" alt="">
                    </div>
                    <div class="text_cart">Giỏ hàng chưa có sản phẩm nào</div>
                    <a href="{{ route('list') }}" class="path">Mua sắm ngay</a>
                </div>
            @else
                <form action="{{ route('cart.update') }}" method="post">
                    @csrf
                    <div class="sectione" id="info-cart-wp">
                        <div class="section-detail table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Mã sản phẩm</td>
                                        <td>Ảnh sản phẩm</td>
                                        <td>Thông tin sản phẩm</td>
                                        <td>Giá sản phẩm</td>
                                        <td>Số lượng</td>
                                        <td colspan="2">Thành tiền</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Cart::content() as $item)
                                        <tr>
                                            <td>
                                                {{ $item->options->code }}
                                            </td>
                                            <td>
                                                <a href="{{ route('detail', $item->options->slug) }}" title=""
                                                    class="thumb">
                                                    <img src="{{ asset($item->options->image_url) }}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('detail', $item->options->slug) }}" title=""
                                                    class="name-product" id="name_product">{{ $item->name }}</a>
                                                <p id="size">Size giày: <span>{{ $item->options->size }}</span></p>
                                            </td>
                                            <td>{{ number_format($item->price) }}đ</td>
                                            <td>
                                                <input type="number" min="1" style="width:50px; text-align: center"
                                                    name="qty[{{ $item->rowId }}]" value="{{ $item->qty }}">
                                            </td>
                                            <td>{{ number_format($item->total) }}đ</td>
                                            <td>
                                                <a href="{{ route('cart.remove', $item->rowId) }}" title="Xóa"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')"
                                                    class="del-product">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            <div>
                                                <p id="total-price" class="fl-right">Tổng giá:
                                                    <span><?php echo Cart::total(); ?>đ</span>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">
                                            <div>
                                                <div class="fl-right">
                                                    <input type="submit" value="Cập nhật giỏ hàng" id="update-cart">
                                                    <a href="{{ route('checkout') }}" title=""
                                                        id="checkout-cart">Thanh toán</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="sectione" id="action-cart-wp">
                        <div class="section-detail">
                            <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào
                                số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất
                                mua hàng.
                            </p>
                            <a href="" title="" id="buy-more">Mua tiếp</a><br />
                            <a href="{{ route('cart.destroy') }}" title="Xóa"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa toàn bộ giỏ hàng không?')"
                                id="delete-cart">Xóa toàn bộ giỏ hàng</a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="block_product-item_outer">
                            @foreach (Cart::content() as $item)
                                <div class="block_product-item d-flex">
                                    <div class="product-thumb mx-2">
                                        <a class="image-control" href="">
                                            <img src="{{ asset($item->options->image_url) }}" alt="">
                                        </a>
                                    </div>
                                    <div class="product-info mx-2">
                                        <div class="d-flex">
                                            <div class="d-flex flex-column">
                                                <a href="" class="product-name">{{ $item->name }}</a>
                                                <div class="product-size">Size giày:
                                                    <span>{{ $item->options->size }}</span>
                                                </div>
                                            </div>

                                            <a href="{{ route('cart.remove', $item->rowId) }}" title="Xóa"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')"
                                                class="remove-item">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-end">
                                            <div class="box-price d-flex">
                                                <p class="product-price">{{ number_format($item->price) }}đ</p>
                                                <p class="product-initial">
                                                    {{ number_format($item->options->initial) }}đ
                                                </p>
                                            </div>
                                            <div class="action">
                                                <a title="Giảm" class="minus"><i class="fa fa-minus"></i></a>
                                                <input type="number" name="qty[{{ $item->rowId }}]" id="num-order"
                                                    min="1" max="100" value="{{ $item->qty }}" readonly>
                                                <a title="Tăng" class="plus"><i class="fa fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div id="stickyBottomBar" class="d-flex justify-content-between">
                                <div class="price-temp">
                                    <p>Tạm tính</p> <span><?php echo Cart::total(); ?>đ</span>
                                </div>
                                <button class="btn-update">Cập nhật</button>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection

@section('addJs')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.minus').forEach(function(minusButton) {
                minusButton.addEventListener('click', function(event) {
                    event.preventDefault();
                    var input = this.nextElementSibling;
                    if (input && input.type === 'number') {
                        var currentValue = parseInt(input.value);
                        if (!isNaN(currentValue) && currentValue > parseInt(input.min)) {
                            input.value = currentValue - 1;
                        }
                    }
                });
            });

            document.querySelectorAll('.plus').forEach(function(plusButton) {
                plusButton.addEventListener('click', function(event) {
                    event.preventDefault();
                    var input = this.previousElementSibling;
                    if (input && input.type === 'number') {
                        var currentValue = parseInt(input.value);
                        if (!isNaN(currentValue) && currentValue < parseInt(input.max)) {
                            input.value = currentValue + 1;
                        }
                    }
                });
            });
        });
    </script>
@endsection
