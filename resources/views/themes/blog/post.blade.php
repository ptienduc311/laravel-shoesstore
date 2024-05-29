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
                    @foreach ($post_cat as $data)
                        @php
                            $posts = $data->posts;
                            $count = $posts->count();
                        @endphp
                        @if ($count > 0)
                            <div class="section-head clearfix">
                                <h3 class="section-title">{{ $data->category_name }}</h3>
                            </div>
                            <div class="section-detail">
                                <ul class="list-item">
                                    @foreach ($posts as $item)
                                        <li class="clearfix">
                                            <a href="{{route('post.detail', $item->slug)}}" title="" class="thumb fl-left">
                                                <img src="{{ asset($item->image->src) }}" alt="">
                                            </a>
                                            <div class="info fl-right">
                                                <a href="{{route('post.detail', $item->slug)}}" title="" class="title">{{ $item->title }}</a>
                                                <span class="create-date">{{ $item->created_at }}</span>
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
