@extends('layouts.app')

@if ($page->title == 'Liên hệ')
    @section('title', 'Liên hệ')
@else
    @section('title', 'Giới thiệu')
@endif

@section('content')
    <div id="main-content-wp" class="clearfix detail-blog-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="/" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a class="path_active" href="{{route('page', $page->slug)}}" title="">{{ $page->title }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="detail-blog-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title">{{ $page->title }}</h3>
                    </div>
                    <div class="section-detail">
                        <div class="detail">
                            @php
                                echo $page->content;
                            @endphp
                        </div>
                    </div>
                </div>
                <div class="section" id="social-wp">
                    <div class="section-detail">
                        <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small"
                            data-show-faces="true" data-share="true"></div>
                        <div class="g-plusone-wp">
                            <div class="g-plusone" data-size="medium"></div>
                        </div>
                        <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                    </div>
                </div>
            </div>
            <div class="sidebar fl-left">
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
                                            <span class="old">{{ $product->initial }}đ</span>
                                        </div>
                                        <a href="{{ route('detail', $product->slug) }}" title="" class="buy-now">Mua
                                            ngay</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="section" id="banner-wp">
                    <div class="section-detail">
                        <a href="#" title="" class="thumb">
                            <img src="{{ asset('themes/images/banner-shoes.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
