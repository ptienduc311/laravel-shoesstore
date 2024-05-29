@extends('layouts.app')

@section('title', 'Blog')
@section('content')
    <div id="main-content-wp" class="home-page clearfix">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="/" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a class="path_active" href="{{route('post')}}" title="">Blog</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="list-blog-wp">
                    <h2 class="section-title">{{ $post->title }}</h2>
                    <p>@php
                        echo $post->content;
                    @endphp</p>
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
                                    <a href="{{ route('product.category', $item->category_slug) }}" title="{{ $item->category_name }}">{{ $item->category_name }}</a>
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
                        <a href="" title="" class="thumb">
                            <img src="{{ asset('themes/images/banner-shoes.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
