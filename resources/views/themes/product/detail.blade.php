@extends('layouts.app')

@section('title', 'Chi tiết sản phẩm')
@section('content')
    <div id="main-content-wp" class="clearfix detail-product-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="/" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="{{route('list')}}" title="">Sản phẩm</a>
                        </li>
                        <li>
                            <a class="path_active" href="" title="">{{ $product->name }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="detail-product-wp">
                    <div class="section-detail clearfix">
                        <div class="thumb-wp fl-left">
                            <div class="img_show">
                                <a href="" title="" id="main-thumb">
                                    <img id="zoom" src="{{ asset($product->images[0]->src) }}"
                                        data-zoom-image="{{ asset($product->images[0]->src) }}" />
                                </a>
                            </div>
                            <div id="list-thumb">
                                @foreach ($product->images as $item)
                                    <a href="" data-image="{{ asset($item->src) }}"
                                        data-zoom-image="{{ asset($item->src) }}">
                                        <img id="zoom" src="{{ asset($item->src) }}" />
                                    </a>
                                @endforeach

                            </div>
                        </div>
                        <div class="thumb-respon-wp fl-left">
                            <img src="{{ asset($product->images[0]->src) }}" alt="">
                        </div>
                        {!! Form::open(['route' => ['cart.add', $product->id], 'method' => 'POST']) !!}
                        <div class="info fl-right">
                            <h3 class="product-name">{{ $product->name }}</h3>
                            <div class="desc">
                                <p>Mã sản phẩm : <span
                                        style="font-weight: bold; color: #fa3a3a;">{{ $product->code }}</span>
                                </p>
                            </div>
                            <div class="num-product">
                                <span class="title">Sản phẩm: </span>
                                @if ($product->status == 'out_of_stock' || $product->stock_quantity == 0)
                                    <span class="status">Hết hàng</span>
                                @else
                                    <span class="status">Còn hàng</span>
                                @endif
                                <p class="price">
                                    <span style="font-size: 15px; color: #8b8282; text-decoration: line-through;">
                                        {{ number_format($product->initial) }}đ</span>
                                    {{ number_format($product->price) }}đ
                                </p>
                            </div>
                            <div id="num-order-wp">
                                <p style="display: inline-block; color: #666;">Chọn số lượng: </p>
                                <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                {!! Form::number('quantity', 1, [
                                    'id' => 'num-order',
                                    'min' => '1',
                                    'max' => $product->stock_quantity,
                                ]) !!}
                                <a title="" id="plus"><i class="fa fa-plus"></i></a>
                                <div class="size-container">
                                    @foreach ($sizes as $id => $name)
                                        {!! Form::radio('size', $id, '', ['class' => 'size', 'id' => 'size-' . $id]) !!}
                                        {!! Form::label('size-' . $id, $name) !!}
                                    @endforeach
                                    @error('size')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                @if ($product->status == 'out_of_stock' || $product->stock_quantity == 0)
                                    <input type="submit" class="add-cart" name="btn_addCart" value="Thêm giỏ hàng"
                                        disabled>
                                    {{-- <input type="submit" class="checkout" name="btn_checkout" value="Thanh toán" disabled> --}}
                                @else
                                    <input type="submit" class="add-cart" name="btn_addCart" value="Thêm giỏ hàng">
                                    {{-- <input type="submit" class="checkout" name="btn_checkout" value="Thanh toán"> --}}
                                @endif
                            </div>
                            {!! Form::close() !!}
                        </div>
                        </form>
                    </div>
                </div>
                <div class="section" id="post-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Mô tả sản phẩm</h3>
                    </div>
                    <div class="section-detail">
                        <p>
                            @php
                                echo $product->detail;
                            @endphp
                        </p>
                    </div>
                    <div class="section-head">
                        <h3 class="section-title">Thông số sản phẩm</h3>
                    </div>
                    <div class="section-detail">
                        <p>
                            @php
                                echo $product->parameter;
                            @endphp
                        </p>
                    </div>
                </div>
                <div class="section" id="same-category-wp">
                    <div class="section-head">
                        <h3 class="section-title">Cùng chuyên mục</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            @foreach ($products_same as $product)
                                <li>
                                    <a href="" title="" class="thumb-same">
                                        <img src="{{ asset($product->images[0]->src) }}">
                                    </a>
                                    <a href="" title="" class="product-name">{{ $product->name }}</a>
                                    <div class="price">
                                        <span class="new">{{ number_format($product->initial) }}đ</span>
                                        <span class="old">{{ number_format($product->price) }}đ</span>
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
                                    <a href="{{ route('product.category', $item->category_slug) }}"
                                        title="">{{ $item->category_name }}</a>
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
