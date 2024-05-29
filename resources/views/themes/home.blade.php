@extends('layouts.app')

@section('title', 'Giày đẹp, phong cách, trẻ trung')
@section('content')
    <div id="main-content-wp" class="home-page clearfix">
        <div class="wp-inner">
            <div class="main-content fl-right">
                <div class="section" id="slider-wp">
                    <div class="section-detail">
                        @foreach ($sliders as $item)
                            <div class="item">
                                <img src="{{ asset($item->image->src) }}" alt="{{$item->image->name}}">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="section" id="support-wp">
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <li>
                                <div class="thumb">
                                    <img src="{{ asset('themes/images/icon-1.png') }}">
                                </div>
                                <h3 class="title">Miễn phí vận chuyển</h3>
                                <p class="desc">Tới tận tay khách hàng</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="{{ asset('themes/images/icon-2.png') }}">
                                </div>
                                <h3 class="title">Tư vấn 24/7</h3>
                                <p class="desc">1900.9999</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="{{ asset('themes/images/icon-3.png') }}">
                                </div>
                                <h3 class="title">Tiết kiệm hơn</h3>
                                <p class="desc">Với nhiều ưu đãi cực lớn</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="{{ asset('themes/images/icon-4.png') }}">
                                </div>
                                <h3 class="title">Thanh toán nhanh</h3>
                                <p class="desc">Hỗ trợ nhiều hình thức</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="{{ asset('themes/images/icon-5.png') }}">
                                </div>
                                <h3 class="title">Đặt hàng online</h3>
                                <p class="desc">Thao tác đơn giản</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="section" id="feature-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Sản phẩm nổi bật</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            @foreach ($products_featured as $product)
                                <li>
                                    <a href="{{ route('detail', $product->slug) }}" title="" class="thumb-same">
                                        <img src="{{ asset($product->images[0]['src']) }}">
                                    </a>
                                    <a href="{{ route('detail', $product->slug) }}" title=""
                                        class="product-name">{{ $product->name }}</a>
                                    <div class="price">
                                        <span class="new">{{ number_format($product->price) }}đ</span>
                                        <span class="old">{{ number_format($product->initial) }}đ</span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="{{ route('detail', $product->slug) }}" title="" class="buy-now">Mua
                                            ngay</a>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="section" id="list-product-wp">
                    @foreach ($categories as $category)
                        @php
                            $products = App\Product::where('category_id', $category->id)->where('status', '!=', 'inactive')->get();
                            $count = $products->count();
                        @endphp
                        @if ($count > 0)
                            <div class="section-head">
                                <h3 class="section-title">{{ $category->category_name }}</h3>
                            </div>
                            <div class="section-detail">
                                <ul class="list-item clearfix">
                                    @foreach ($products as $product)
                                        <li>
                                            <a href="{{ route('detail', $product->slug) }}" title=""
                                                class="thumb-same">
                                                <img src="{{ asset($product->images[0]->src) }}">
                                            </a>
                                            <a href="{{ route('detail', $product->slug) }}" title=""
                                                class="product-name">{{ $product->name }}</a>
                                            <div class="price">
                                                <span class="new">{{ number_format($product->price) }}đ</span>
                                                <span class="old">{{ number_format($product->initial) }}đ</span>
                                            </div>
                                            <div class="action clearfix">
                                                <a href="{{ route('detail', $product->slug) }}" title=""
                                                    class="buy-now">Mua ngay</a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="sidebar fl-left">
                <div class="section" id="category-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Danh mục sản phẩm</h3>
                    </div>
                    <div class="secion-detail">
                        <ul class="list-item">
                            @foreach ($categories as $item)
                                <li>
                                    <a href="{{route('product.category', $item->category_slug)}}" title="">{{ $item->category_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="section" id="selling-wp">
                    <div class="section-head">
                        <h3 class="section-title">Sản phẩm bán chạy</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            @foreach ($products_selling as $product)
                                <li class="clearfix">
                                    <a href="{{ route('detail', $product->slug) }}" title="" class="thumb fl-left">
                                        <img src="{{ asset($product->images[0]['src']) }}" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="{{ route('detail', $product->slug) }}" title=""
                                            class="product-name">{{ $product->name }}</a>
                                        <div class="price">
                                            <span class="new">{{ number_format($product->price) }}đ</span>
                                            <span class="old">{{ number_format($product->initial) }}đ</span>
                                        </div>
                                        <a href="{{ route('detail', $product->slug) }}" title=""
                                            class="buy-now">Mua ngay</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="section" id="banner-wp">
                    <div class="section-detail">
                        <a href="" title="" class="thumb">
                            <img src="{{ asset('themes/images/banner-shoes.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
